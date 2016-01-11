<?php
/**
 * Created by PhpStorm.
 * User: Romain
 * Date: 06/11/2015
 * Time: 16:37
 */

namespace Produit\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Panier implements InputFilterAwareInterface
{
    public $id;
    public $designation;
    public $prixUnitaire;
	public $quantite;
	public $tva;
    protected $inputFilter;

    public function exchangeArray($data)
    {
        $this->id     = (!empty($data['id'])) ? $data['id'] : null;
        $this->designation = (!empty($data['designation'])) ? $data['designation'] : null;
        $this->prixUnitaire  = (!empty($data['prixUnitaire'])) ? $data['prixUnitaire'] : null;
		$this->quantite  = (!empty($data['quantite'])) ? $data['quantite'] : null;
		$this->tva  = (!empty($data['tva'])) ? $data['tva'] : null;
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();

            $inputFilter->add(array(
                'name'     => 'id',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'designation',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'prixUnitaire',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));
			
			$inputFilter->add(array(
                'name'     => 'quantite',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));
			
			$inputFilter->add(array(
                'name'     => 'tva',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}

