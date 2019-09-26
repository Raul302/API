'use strict'
/** @typedef {import('@adonisjs/framework/src/Request')} Request */
/** @typedef {import('@adonisjs/framework/src/Response')} Response */
/** @typedef {import('@adonisjs/framework/src/View')} View */

class User {
  /**
   * @param {object} ctx
   * @param {Request} ctx.request
   * @param {Function} next
   */
  async handle ({ response,request,auth }, next) {
   
   try{
    if (auth.user.id !=1) {
      return response.status(401).json({
        message : 'Sin permisos'
      })
    }
    await next()
    // PROSEGUIR
   }catch(error)
   {
    return response.status(400).json({
      message : 'Ups!Algo ocurrio'
    })

   }
    // // call next to advance the request
    // let id= await auth.id
    // if(!id==1)
    // {
    //   return response.status(201).json(id)
    // }
    // return response.status(404).json(id)
   

    // const ip = request.ip()
    // request.country = geoip.lookup(ip).country
      // await next()
  }
}

module.exports = User
