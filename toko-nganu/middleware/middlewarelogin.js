export default function({store, redirect}){


  store.dispatch('users/setcookie')
  if(store.state.users.authenticated){

    return redirect('/')
  }

}
