<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Position;
use AppBundle\Entity\Users;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class UsersAdmin extends AbstractAdmin
{
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('firstname')
            ->add('lastname')
            ->add('phone')
            ->add('email')
            ->add('position', null, [], EntityType::class,
              [
                'class' => Position::class,
                'choice_label' => 'poSition'
              ])
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('position.position')
            ->addIdentifier('firstname')
            ->add('lastname')
            ->add('phone')
            ->add('email')
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ])

        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
          ->with('Content', ['class' => 'col-md-9'])
            ->add('firstname')
            ->add('lastname')
            ->add('phone')
            ->add('email')
          ->end()

          ->with('Meta data', ['class' => 'col-md-3'])
            ->add('position', EntityType::class, [
              'class' => Position::class,
                'choice_label' => 'position'
            ])
          ->end()
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('firstname')
            ->add('lastname')
            ->add('phone')
            ->add('email')
        ;
    }

    /*protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('pdf', $this->getRouterIdParameter().'/pdf_link');
    }*/

    public function toString($object) {
        return $object instanceof Users ? $object->getFirstname() : 'User';
    }

}
