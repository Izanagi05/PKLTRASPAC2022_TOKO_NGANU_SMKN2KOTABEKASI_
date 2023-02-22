// import Cookies from 'cookie-universal-nuxt'
export const state = () =>{
  return {
    authenticated:null,
    // getcookie: null

  }
}

export const mutations = {



  msetcookie(state, payload){
    state.authenticated = payload


  }
}
export const actions = {
  setcookie({commit}){
    const cookieku =this.$cookies.get('cookieku')
    commit('msetcookie', cookieku)
  },
  login({commit}, payload){
    this.$cookies.set('cookieku', payload)
    commit('msetcookie')
    window.location.replace('/')
    // return redirect('/')
  },
  logout({commit}){
    window.location.replace('/login')
    this.$cookies.remove('cookieku')
    alert('berhasil logout')
    commit('msetcookie')
    // this.$router.push('/login')
  }
}
