<?php

namespace App\Presenters;

use App\Transformers\ComplaintItemTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ComplaintItemPresenter.
 *
 * @package namespace App\Presenters;
 */
class ComplaintItemPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ComplaintItemTransformer();
    }
}
