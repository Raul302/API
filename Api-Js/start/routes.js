'use strict'

/*
|--------------------------------------------------------------------------
| Routes
|--------------------------------------------------------------------------
|
| Http routes are entry points to your web application. You can create
| routes for different URLs and bind Controller actions to them.
|
| A complete guide on routing is available here.
| http://adonisjs.com/docs/4.1/routing
|
*/

/** @type {typeof import('@adonisjs/framework/src/Route/Manager')} */
const Route = use('Route')

Route.get('/', () => {
  return { greeting: 'Hello world in JSON' }
})

Route.post('registrar', 'UserController.registrar')
Route.post('iniciar', 'UserController.iniciar')
Route.post('ejemplo', 'UserController.ejemplo')
Route.get('cerrar', 'UserController.cerrar') .middleware(['auth:api'])
Route.get('all','UserController.all').middleware(['auth:api','user'])
