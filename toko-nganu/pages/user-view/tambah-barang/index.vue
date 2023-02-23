<template>
  <div>

    <div>Tambah barang toko</div>
    <v-text-field v-model="databarang.nama" placeholder="Nama"></v-text-field>
    <v-text-field v-model="databarang.deskripsi" placeholder="Deskripsi"></v-text-field>
    <!-- <v-text-field v-model="databarang.kategori_id" placeholder="Kategori"></v-text-field> -->
    <!-- {{ usertoko }} -->
    <select v-model="databarang.kategori_id" label="Pilih">
      <option disabled >Pilih Toko</option>
      <option v-for="(toko, index) in kategori" :value="toko.kategori_id" :key="index">
         {{ toko.nama }}
       </option>

    </select>
    <select v-model="databarang.toko_id" label="Pilih">
      <option disabled >Pilih Toko</option>
      <option v-for="(toko, index) in usertoko" :value="toko.toko_id" :key="index">
         {{ toko.nama }}
       </option>

    </select>
    <v-btn @click="tbhbarang()">buat</v-btn>
  </div>
</template>
<script>
import axios from 'axios'
export default {
  middleware:'middlewareku',
  data() {
    return {

      // items:null,
      usertoko:null,
      userid:null,
      kategori:null,
      databarang:{
        toko_id:null,
        nama:null,
        deskripsi:null,
        kategori_id:null,
      }
    }
  },

  methods: {
    gettokouser(){
      axios.get('http://127.0.0.1:8000/api/gettoko/'+ this.userid).then(respon=> {
       this.usertoko = respon.data
      //  this.items = respon.data
      })
    },
    getkategori(){
      axios.get('http://127.0.0.1:8000/api/getallkategori').then(respon=> {
       this.kategori = respon.data
      })
    },
    tbhbarang(){
      axios.post('http://127.0.0.1:8000/api/createbarang/'+ this.databarang.toko_id, this.databarang).then(respon=> {
        this.$router.push('/toko-user')
        console.log(respon)
      })
    }
  },
  created(){
    const  idnya = this.$cookies.get('cookieku')
    this.userid = idnya.data.id
    this.gettokouser()
    this.getkategori()
    },
}
</script>
