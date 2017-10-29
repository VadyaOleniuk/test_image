<?php
namespace AppBundle\Model;

use Gregwar\Image\Image;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BuilderImage{
    const FORMAT = 0.2645833333333;

    private $params;
    private $img;

    private $uniquePicture;

    public function __construct($params)
    {
        $this->params = $params;
        $this->getPicture($params);
    }

    public function getParams($hight)
    {
        $this->img = Image::create($this->getPx($this->uniquePicture['width']), $this->getPx($this->uniquePicture['height']))
            ->fill('white');
        foreach ($this->uniquePicture['label'] as $value){
            $this->img->rectangle($value['x'],
                $value['y'],
                $value['x1'],
                $value['y1'],
                'black',
                $filled = false);
        }

        return Image::open($this->img->gif())
            ->forceResize($hight/2, $hight)
            ->save($this->uniquePicture['name'].'.jpg');
        
    }

    private function getPx($value)
    {
        return $value/self::FORMAT;
    }
    
    private function getPicture($params)
    {
        try {
            $x = $params['LeftMargin'];
            $this->uniquePicture['name'] = $params['name'];
            for ($width = 0; $width < $params['LabelTableSize']['Width']; $width++) {
                $y = $params['BottomMargin'];
                for ($hieght = 0; $hieght < $params['LabelTableSize']['Height']; $hieght++) {
                    $y2 = $y + $params['LabelSize']['Height'] + $params['HorizSpacing'];
                    $x2 = $x + $params['LabelSize']['Width'];
                    $this->uniquePicture['label'][] = [
                        'x' => $this->getPx($x),
                        'y' => $this->getPx($y),
                        'x1' => $this->getPx($x + $params['LabelSize']['Width']),
                        'y1' => $this->getPx($y2),
                    ];
                    $y = $y2 + $params['LabelSize']['Height'];
                }

                $x += $params['LabelSize']['Width'] + $params['VertSpacing'];
            }
            $this->uniquePicture['height'] = $y2 + $params['BottomMargin'];
            $this->uniquePicture['width'] = $x2 + $params['RightMargin'];
        }catch (Exception $e){
            new NotFoundHttpException('setting bad parameters');
        }
    }
}