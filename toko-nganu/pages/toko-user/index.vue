<template>
  <div>
    <Navbar/>

    <div>
      <v-container>
        <h1>Daftar Toko</h1>
        <div v-for="(tk, index) in Toko" :key="index">

          <v-row>
            <v-col>
              Nama Toko : {{ tk.nama }}
            </v-col>
            <v-col>
              Deskripsi Toko : {{ tk.deskripsi }}
            </v-col>
            <v-col>
              Alamat Toko : {{ tk.alamat }}
            </v-col>
            <v-col>
              <div v-for="(brg, index) in tk.barang" :key="index">

                Nama Barang : {{ brg.nama}}
                Deskripsi Barang : {{ brg.deskripsi}}
              </div>
            </v-col>
            <v-col>
              <nuxt-link to="/toko-user/detailtoko">
                <v-btn><v-icon>mdi-eye</v-icon></v-btn>
              </nuxt-link>
            </v-col>
          </v-row>
        </div>
      </v-container>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  middleware: 'middlewareku',
  data() {
      return {
        cari:null,
        nama:null,
        tokouser:null,
        Toko:null
      }
    },
  methods: {
    gettoko(){
      axios.get('http://127.0.0.1:8000/api/getbarang/'+this.tokouser).then(respon=>{
        this.Toko = respon.data
      })
    }
  },

  created(){
     const  userid = this.$cookies.get('cookieku')
    this.tokouser = userid.data.id
    this.gettoko()
    },

};
</script>
