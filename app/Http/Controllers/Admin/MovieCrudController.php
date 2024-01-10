<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MovieRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class MovieCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class MovieCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    private function getFieldsData($show = FALSE) {
        return [
            [
                'name'=> 'name',
                'label' => 'Title',
                'type'=> 'text'
            ],
            [
                'label' => "Movie banner",
                'name' => "image",
                'type' => ($show ? 'view' : 'upload'),
                'view' => 'partials/image',
                'upload' => true,
            ],
            [
                'name' => 'release_date',
                'label' => 'Release Date (blank if unavailable)',
                'type' => 'date'
            ],
            [
                'name'=> 'language',
                'label' => 'Original Language',
                'type'=> 'text'
            ],
            [    // SelectMultiple = n-n relationship (with pivot table)
                'label'     => "Genres",
                'type'      => ($show ? "select": 'select_multiple'),
                'name'      => 'genres', // the method that defines the relationship in your Model
                // optional
                'entity'    => 'genres', // the method that defines the relationship in your Model
                'model'     => "App\Models\Genre", // foreign key model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'pivot'     => true, // on create&update, do you need to add/delete pivot table entries?
            ],
            [
                'name' => 'status',
                'label' => "Status",
                'type' => 'enum',

                'options' => [
                    'Planned' => 'Planned',
                    'In Production' => 'In Production',
                    'Released' => 'Released',
                    'Cancelled' => 'Cancelled'
                ]
            ],
            [
                'name'=> 'score',
                'label' => 'User Score (0 if unavailable)',
                'type'=> 'number'
            ],
            [    // SelectMultiple = n-n relationship (with pivot table)
                'label'     => "Producers",
                'type'      => ($show ? "select": 'select_multiple'),
                'name'      => 'producers', // the method that defines the relationship in your Model
                // optional
                'entity'    => 'producers', // the method that defines the relationship in your Model
                'model'     => "App\Models\Producer", // foreign key model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'pivot'     => true, // on create&update, do you need to add/delete pivot table entries?
            ]
        ];
    }

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Movie::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/movie');
        CRUD::setEntityNameStrings('movie', 'movies');

        $this->crud->addFields($this->getFieldsData());
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->set('show.setFromDb', false);
        $this->crud->addColumns($this->getFieldsData(TRUE));
    }

    protected function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', false);
        $this->crud->addColumns($this->getFieldsData(TRUE));
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(MovieRequest::class);
        CRUD::setFromDb(); // set fields from db columns.

        /**
         * Fields can be defined using the fluent syntax:
         * - CRUD::field('price')->type('number');
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
