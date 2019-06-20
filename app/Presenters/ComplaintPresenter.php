<?php

namespace App\Presenters;

use App\Transformers\ComplaintTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ComplaintPresenter.
 *
 * @package namespace App\Presenters;
 */
class ComplaintPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ComplaintTransformer();
    }
}
