'use strict'
const User = use('App/Models/User')
const Token = use('App/Models/Token')


class UserController {


    async registrar ({ request, response }) {
       const objeto = request.all();
        try {
            const user = new User()
            user.email = objeto.email;
            user.username = objeto.username;
            user.password = objeto.password;
            await user.save()
            return response.status(201).json({
                message: 'usuario creado con exito',
                user: user
            })
        } catch (error) {
            return response.status(400).json({
                status: 'error',
                message: 'There was a problem creating the user, p  lease try again later.'
            })
        }
    }
    async iniciar ({ request,auth, response }) {
        try { 
           // Recuperar todo del request
        let {email, password} = request.all();
         let token=await auth.attempt(email, password)
          //   // let user = await User.findBy('email', email)
          //   // let token = await auth.generate(user)
          //   return response.status(201).json(token)
          return response.status(201).send(token.token)
          
        }
        catch (e) {
          return response.status(400).json({
            message:'Ups!algo ocurrio,intenta de nuevo mas tarde'
          })
        }
      }

     async cerrar ({ request,auth, response }) {
       try{
        const apiToken = auth.getAuthHeader()
        // Revoketokenforuser TODOS LOS TOKEN REVOKADOS
        await auth
          .authenticator('api')
          .revokeTokens([apiToken])
           return response.status(200).json({
            message: 'Token revokado'
          
        })
       }catch(e)
       {
        return response.status(404).json({
            message: 'Ocurrio un error',
            error: event
          
        })
       }
        
     }
     async all ({request,auth, response })
     {
       let user = User.all()
       return user
     }
      async ejemplo ({request,auth, response })
     {
      return response.status(200).json({
        message: 'Hola mundo'
     })
    }
}

module.exports = UserController
