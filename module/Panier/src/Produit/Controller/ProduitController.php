<?php
/**
 * Created by PhpStorm.
 * User: Romain
 * Date: 06/11/2015
 * Time: 16:28
 */
namespace Produit\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Produit\Model\Produit;
use Produit\Form\ProduitForm;

class ProduitController extends AbstractActionController
{

    protected $produitTable;


    public function indexAction()
    {
        return new ViewModel(array(
            'produits' => $this->getProduitTable()->fetchAll(),
        ));
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('produit', array(
                'action' => 'add'
            ));
        }

        // Get the Album with the specified id.  An exception is thrown
        // if it cannot be found, in which case go to the index page.
        try {
            $produit = $this->getProduitTable()->getProduit($id);
        }
        catch (\Exception $ex) {
            return $this->redirect()->toRoute('produit', array(
                'action' => 'index'
            ));
        }

        $form  = new ProduitForm();
        $form->bind($produit);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($produit->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getProduitTable()->saveProduit($produit);

                // Redirect to list of albums
                return $this->redirect()->toRoute('produit');
            }
        }

        return array(
            'id' => $id,
            'form' => $form,
        );
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('produit');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->getProduitTable()->deleteProduit($id);
            }

            // Redirect to list of albums
            return $this->redirect()->toRoute('produit');
        }

        return array(
            'id'    => $id,
            'produit' => $this->getProduitTable()->getProduit($id)
        );
    }

    public function getProduitTable()
    {
        if (!$this->produitTable) {
            $sm = $this->getServiceLocator();
            $this->produitTable = $sm->get('Produit\Model\ProduitTable');
        }
        return $this->produitTable;
    }

    public function addAction()
    {
        $form = new ProduitForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $produit = new Produit();
            $form->setInputFilter($produit->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $produit->exchangeArray($form->getData());
                $this->getProduitTable()->saveProduit($produit);

                // Redirect to list of albums
                return $this->redirect()->toRoute('produit');
            }
        }
        return array('form' => $form);
    }
}
