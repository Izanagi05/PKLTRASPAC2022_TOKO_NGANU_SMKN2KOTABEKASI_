<template>
  <div>

    <h1>Tambah toko</h1>
    <v-text-field v-model="databarang.nama" placeholder="Nama"></v-text-field>
    <v-text-field v-model="databarang.alamat" placeholder="Alamat"></v-text-field>
    <v-text-field v-model="databarang.deskripsi" placeholder="Deskripsi"></v-text-field>
    <v-text-field v-model="databarang.no_telepon" placeholder="No Telepon"></v-text-field>
    <v-text-field v-model="databarang.logo" placeholder="logo"></v-text-field>
    <v-btn @click="buattoko()">buat</v-btn>
  </div>
</template>
<script>
import axios from 'axios'
export default {
  middleware:'middlewareku',
  data() {
    return {

      databarang:{
        userid:null,
        nama:null,
        alamat:null,
        deskripsi:null,
        no_telepon:null,
        logo:null,
      }
    }
  },

  methods: {
    buattoko(){
      axios.post('http://127.0.0.1:8000/api/createtoko/'+ this.userid, this.databarang).then(respon=> {
        this.$router.push('/toko-user')
        console.log(respon)
      })
    }
  },
  created(){
     const  usid = this.$cookies.get('cookieku')
    this.userid = usid.data.id
    },
}
</script>
