<template>
  <div>
    <Navbar />
    detail toko
  </div>
</template>
<script>
import axios from 'axios';
export default {
  middleware:'middlewareku',
  data() {
    return {
      Toko:null,
      barangtoko:null,
      // Toko:null,
    }
  },
  methods: {
    getbarang(){
      axios.get('http://127.0.0.1:8000/api/getbarang/1').then(respon=>{
        this.Toko = respon.data
      })
    }
  },

  created(){
     const  tokoid = this.$cookies.get('cookieku')
    this.barangtoko = tokoid.data.id
    this.getbarang()
    },
}
</script>
