<?php
/**
 * Created by PhpStorm.
 * User: Romain
 * Date: 13/11/2015
 * Time: 13:46
 */

namespace Produit\Form;

use Zend\Form\Form;

class ProduitForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('produit');

        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden',
        ));
        $this->add(array(
            'name' => 'designation',
            'type' => 'Text',
            'options' => array(
                'label' => 'Designation',
            ),
        ));
        $this->add(array(
            'name' => 'prixUnitaire',
            'type' => 'Text',
            'options' => array(
                'label' => 'Prix Unitaire',
            ),
        ));
		$this->add(array(
            'name' => 'quantite',
            'type' => 'Text',
            'options' => array(
                'label' => 'Quantite',
            ),
        ));
		$this->add(array(
            'name' => 'tva',
            'type' => 'Text',
            'options' => array(
                'label' => 'Tva',
            ),
        ));
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Go',
                'id' => 'submitbutton',
            ),
        ));
    }
}