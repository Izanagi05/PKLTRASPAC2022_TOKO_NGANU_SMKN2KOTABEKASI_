// import Cookies from 'cookie-universal-nuxt'
export const state = () =>{
  return {
    authenticated:null,
    cekuser:null,
    // getcookie: null

  }
}

export const mutations = {



  msetcookie(state, payload){
    state.authenticated = payload
  },
  msetcookiecekuser(state, payload){
    state.cekuser = payload
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
  logincekuser({commit}, payload){
    this.$cookies.set('cekuserlogin', payload)
    commit('msetcookiecekuser')
    // return redirect('/')
  },
  resetlogincekuser({commit}){
    this.$cookies.remove('cekuserlogin')
    commit('msetcookiecekuser')
    // return redirect('/')
  },
  logout({commit}){
    window.location.replace('/login')
    this.$cookies.remove('cookieku')
    this.$toast.success("Berhasil logout");
    commit('msetcookie')
    // this.$router.push('/login')
  }
}
