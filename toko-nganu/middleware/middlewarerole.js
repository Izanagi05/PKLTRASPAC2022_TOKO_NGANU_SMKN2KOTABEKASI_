
export default function({store, redirect, $cookies}){


  store.dispatch('users/setcookie')
  const cekadmin = $cookies.get('cookieku')
  if(store.state.users.authenticated && cekadmin.role === "User"){
    return redirect('/')
  }else{
    console.log()
    console.log("Lolos middleware login")
  }

}
