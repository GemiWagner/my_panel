<?php
/**
 * Created by PhpStorm.
 * User: Romain
 * Date: 06/11/2015
 * Time: 16:43
 */

namespace Produit\Model;

use Zend\Db\TableGateway\TableGateway;

class PanierTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function getProduit($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveProduit(Produit $produit)
    {
        $data = array(
            'designation' => $produit->designation,
            'prixUnitaire'  => $produit->prixUnitaire,
			'quantite'  => $produit->quantite,
			'tva'  => $produit->tva,
        );

        $id = (int) $produit->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getProduit($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Produit id does not exist');
            }
        }
    }

    public function deleteProduit($id)
    {
        $this->tableGateway->delete(array('id' => (int) $id));
    }

}

