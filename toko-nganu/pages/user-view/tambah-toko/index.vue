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

<style>
.tambah-container {
  padding: 0px 123px;
}
</style>

<script>
import axios from "axios";
export default {
  middleware: "middlewareku",
  data() {
    return {
      databarang: {
        userid: null,
        nama: null,
        alamat: null,
        deskripsi: null,
        no_telepon: null,
        logo: null,
      },
    };
  },

  methods: {
    upload(foto){
    let files = foto.target.files[0];
    this.preview = URL.createObjectURL(files)
    this.photo = files
  },
  buattoko(){

      axios.post('http://127.0.0.1:8000/api/createtoko/'+ this.userid, this.databarang).then(respon=> {
        this.$router.push('/user-view/toko-user')
        console.log(respon)
      })
      // let formData = new FormData()
      // formData.append('logo', this.photo)
      //   axios.post('http://127.0.0.1:8000/api/createtoko/'+ this.userid, formData, {
      //         'content-type': 'multipart/form-data'
      //       })
    }
  },
  created(){
     const  usid = this.$cookies.get('cookieku')
    this.userid = usid.data.id
    },
}
</script>
