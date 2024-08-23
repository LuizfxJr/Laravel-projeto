use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FinancingUpdated
{
    use Dispatchable, SerializesModels;

    public $financingId;

    /**
     * Create a new event instance.
     *
     * @param  int  $financingId
     * @return void
     */
    public function __construct($financingId)
    {
        $this->financingId = $financingId;
    }
}