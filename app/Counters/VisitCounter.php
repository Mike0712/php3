<?php


namespace App\Counters;


use App\Visit;
use App\Mail\MailClass;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Mail;

class VisitCounter
{
    protected $model;

    public function fixVisit()
    {
        $visit = new Visit;
        $visit->save();
    }

    public function notificate($name, $email)
    {
        $subject = 'Статистики посещений сайта supersite.ru';
        $stats = $this->getStats();
        $new = $stats['new'];
        $content = array_replace($stats, ['new' => $new->count()]);

        Mail::to($email)->send(new MailClass(compact('name','subject', 'content'), 'visit_notify'));

        $this->markNotificate($new->get());
    }

    protected function getStats()
    {
        $all = Visit::all()->count();
        $today = Visit::where('created_at', '>=', date('Y-m-d 00:00:00'))->count();
        $new = Visit::where('notificate', '=', false);

        return compact('all','today', 'new');
    }

    protected function markNotificate(Collection $new)
    {
        foreach ($new as $item){
            $item->notificate = true;
            $item->save();
        }
    }
}