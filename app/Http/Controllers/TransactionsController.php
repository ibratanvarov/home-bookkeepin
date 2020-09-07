<?php


namespace App\Http\Controllers;

use App\Category;
use App\RecalculationHistory;
use App\Type;
use App\User;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    public function index()
    {
        $income_categories = Category::where('type_id', Type::INCOME)->get();
        return view('income',compact('income_categories'));
    }

    public function income(Request $request)
    {
        $this->validate($request, [
            'sum'=>'required|integer',
        ]);

        if($request->sum <= 0) {
            return back()->withErrors(['msg' => 'Доход не должно быть меньше нуля'])
                ->withInput();
            //doxod ne doljen bit' menshe nulya
        }
        $previous_history = RecalculationHistory::latest()->first(); // latest = order by desc
        $user = Auth()->user();

        $history = new RecalculationHistory($request->all());
        if (empty($previous_history->total))
        {
            $history->total = 0 + $request->sum;
        }
        else{ $history->total = $previous_history->total + $request->sum;}
        $history->category()->associate($request->category_id);
        $history->type()->associate(Type::INCOME);
        $history->user()->associate($user->id);
        $history->save();

        if ($history)
        {
            return redirect()->route('income.index')
                ->with(['success'=>'Успешно сохранено']);

        }
        else{
            return back()->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }

    public function show()
    {
        $income_categories = Category::where('type_id', Type::OUTGO)->get();
        return view('indexoutgo',compact('income_categories'));
    }

    public function outgo(Request $request)
    {
        $this->validate($request, [
            'sum'=>'required|integer',
        ]);

        if($request->sum <= 0 ) {
            return back()->withErrors(['msg' => 'Доход не должно быть меньше нуля'])
                ->withInput();
        }
        $previous_history = RecalculationHistory::latest()->first();
        $user = Auth()->user();

        if (empty($previous_history->total))
        {
            return back()->withErrors(['msg' => 'У вас нет денег в счёт у'])
                ->withInput();
        }

        if($previous_history->total < $request->sum)
        {
            return back()->withErrors(['msg' => 'Итог не должно быть меньше Суммы'])
                ->withInput();
        }

        $history = new RecalculationHistory($request->all());
        $history->total = $previous_history->total - $request->sum;
        $history->category()->associate($request->category_id);
        $history->type()->associate(Type::OUTGO);
        $history->user()->associate($user->id);
        $history->save();

        if ($history)
        {
            return redirect()->route('outgo.index')
                ->with(['success'=>'Успешно сохранено']);

        }
        else{
            return back()->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }
}
