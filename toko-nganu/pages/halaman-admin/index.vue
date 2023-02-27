<template>
  <div>
    <v-dialog v-model="dialogDeleteuser" max-width="500px">
          <v-card>
            <v-card-title class="text-h5">Yakin ingin menghapus user?</v-card-title>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue-darken-1" variant="text" @click="closeDeleteuser">Cancel</v-btn>
              <v-btn color="blue-darken-1" variant="text" @click="confirmhapususer">OK</v-btn>
              <v-spacer></v-spacer>
            </v-card-actions>
          </v-card>
</v-dialog>
    <v-dialog v-model="dialogDeletetoko" max-width="500px">
          <v-card>
            <v-card-title class="text-h5">Yakin ingin menghapus Toko ini?</v-card-title>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue-darken-1" variant="text" @click="closeDeletetoko">Cancel</v-btn>
              <v-btn color="blue-darken-1" variant="text" @click="confirmhapustoko">OK</v-btn>
              <v-spacer></v-spacer>
            </v-card-actions>
          </v-card>
</v-dialog>
    <div class="bar">
      <div class="contact white--text">
        <div class="contact-text font-weight-regular">+62-000-000-000</div>
      </div>
    </div>
    <div class="home-container">
      <v-row>
        <v-col cols="1">
          <div class="">
            <v-img :src="require('~/assets/logo.png')" width="100px"></v-img>
          </div>
        </v-col>
        <v-col>
          <div class="store-name f24sb">
            <div>Toko Nganu</div>
            <div v-for="(asr, index) in alluser" :key="index">
            {{ asr.nama }}
            </div>
          </div>
        </v-col>
        <v-col>
          <div v-for="(atr, index) in alltoko" :key="index">
          {{ atr.nama }}  ====== <v-btn @click="hapustoko(atr)">hapus</v-btn>
          </div>
          <!-- <v-text-field
            class="search"
            rounded
            placeholder="Search nganu"
            append-icon="mdi-magnify"
          ></v-text-field>           -->
        </v-col>
      </v-row>
      <div class="content">
        <div class="kiri">
          <div class="sub-title ml-5" width="170px" height="30px">
            Halaman Admin
          </div>
          <div class="produk ml-6" style="font-size: 16px">
            <span class="mdi mdi-package-variant-closed">Produk</span>
          </div>
          <div class="tambah-produk ml-6" style="font-size: 16px">
            <span class="mdi mdi-package-variant-closed-plus"
              >Tambah Produk</span
            >
          </div>
          <div class="logout ml-6 pb-4" style="font-size: 16px">
            <span class="mdi mdi-logout mdi-35px">Logout</span>
          </div>
        </div>
        <div class="pembatas mb-6"></div>
        <div class="content">
          <div class="barang pt-5">
            <div>
              <div class="product-card">
                <v-row class="p-0">
                  <v-col class="card-col p-0" width="204px">
                    <v-card width="204px">
                      <v-img
                        :src="require('~/assets/barang.png')"
                        width="204px"
                      ></v-img>
                      <v-row>
                        <v-col cols="5" class="">
                          <div class="title-product f14sb pl-1">Mas bro</div>
                        </v-col>
                        <v-col>
                          <div class="price-product f14sb pr-1">
                            Rp. 1.999.999
                          </div>
                        </v-col>
                      </v-row>
                      <v-row>
                        <v-col>
                          <div class="desc-product font-weight-regular pl-1">
                            Bingung masbro
                          </div>
                        </v-col>
                      </v-row>
                      <div class="btn-card pl-2 pb-3 pt-3">
                        <v-btn
                          class="rounded-xl edit-btn font-weight-regular"
                          style="
                            font-size: 12px;
                            background: #2f432d;
                            color: white;
                          "
                        >
                          Edit
                        </v-btn>
                        <v-btn
                          class="rounded-xl hapus-btn font-weight-medium pl-3"
                          outlined
                          style="font-size: 12px; color: red"
                        >
                          Hapus
                        </v-btn>
                      </div>
                    </v-card>
                  </v-col>
                  <v-col class="card-col p-0">
                    <v-card width="204px">
                      <v-img
                        :src="require('~/assets/barang.png')"
                        width="204px"
                      ></v-img>
                      <v-row>
                        <v-col cols="5" class="">
                          <div class="title-product f14sb pl-1">Mas bro</div>
                        </v-col>
                        <v-col>
                          <div class="price-product f14sb pr-1">
                            Rp. 1.999.999
                          </div>
                        </v-col>
                      </v-row>
                      <v-row>
                        <v-col>
                          <div class="desc-product font-weight-regular pl-1">
                            Bingung masbro
                          </div>
                        </v-col>
                      </v-row>
                      <div class="btn-card pl-2 pb-3 pt-3">
                        <v-btn
                          class="rounded-xl edit-btn font-weight-regular"
                          style="
                            font-size: 12px;
                            background: #2f432d;
                            color: white;
                          "
                        >
                          Edit
                        </v-btn>
                        <v-btn
                          class="rounded-xl hapus-btn font-weight-medium pl-3"
                          outlined
                          style="font-size: 12px; color: red"
                        >
                          Hapus
                        </v-btn>
                      </div>
                    </v-card>
                  </v-col>
                  <v-col class="card-col p-0">
                    <v-card width="204px">
                      <v-img
                        :src="require('~/assets/barang.png')"
                        width="204px"
                      ></v-img>
                      <v-row>
                        <v-col cols="5" class="">
                          <div class="title-product f14sb pl-1">Mas bro</div>
                        </v-col>
                        <v-col>
                          <div class="price-product f14sb pr-1">
                            Rp. 1.999.999
                          </div>
                        </v-col>
                      </v-row>
                      <v-row>
                        <v-col>
                          <div class="desc-product font-weight-regular pl-1">
                            Bingung masbro
                          </div>
                        </v-col>
                      </v-row>
                      <div class="btn-card pl-2 pb-3 pt-3">
                        <v-btn
                          class="rounded-xl edit-btn font-weight-regular"
                          style="
                            font-size: 12px;
                            background: #2f432d;
                            color: white;
                          "
                        >
                          Edit
                        </v-btn>
                        <v-btn
                          class="rounded-xl hapus-btn font-weight-medium pl-3"
                          outlined
                          style="font-size: 12px; color: red"
                        >
                          Hapus
                        </v-btn>
                      </div>
                    </v-card>
                  </v-col>
                  <v-col class="card-col p-0">
                    <v-card width="204px">
                      <v-img
                        :src="require('~/assets/barang.png')"
                        width="204px"
                      ></v-img>
                      <v-row>
                        <v-col cols="5" class="">
                          <div class="title-product f14sb pl-1">Mas bro</div>
                        </v-col>
                        <v-col>
                          <div class="price-product f14sb pr-1">
                            Rp. 1.999.999
                          </div>
                        </v-col>
                      </v-row>
                      <v-row>
                        <v-col>
                          <div class="desc-product font-weight-regular pl-1">
                            Bingung masbro
                          </div>
                        </v-col>
                      </v-row>
                      <div class="btn-card pl-2 pb-3 pt-3">
                        <v-btn
                          class="rounded-xl edit-btn font-weight-regular"
                          style="
                            font-size: 12px;
                            background: #2f432d;
                            color: white;
                          "
                        >
                          Edit
                        </v-btn>
                        <v-btn
                          class="rounded-xl hapus-btn font-weight-medium pl-3"
                          outlined
                          style="font-size: 12px; color: red"
                        >
                          Hapus
                        </v-btn>
                      </div>
                    </v-card>
                  </v-col>
                </v-row>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  middleware: ['middlewareku', 'middlewarerole'],
data() {
  return {
      alluser:{},
      alltoko:{},

      dialogDeleteuser:false,
      dialogDeletetoko:false,
      editedIndex:0,
      detaildatadialoguser:{
        id:''
      },
      detaildatadialogtoko:{
        toko_id:''
      }
  }
},

  methods: {
    getalluser(){
      axios.get('http://127.0.0.1:8000/api/getalluser').then(respon=>{
        console.log(respon)
        this.alluser = respon.data
      })
    },
    hapususer (item) {
        this.editedIndex = this.alluser.indexOf(item)
        this.detaildatadialoguser = Object.assign({}, item)
        this.dialogDeleteuser = true
        console.log(item)
      },
    confirmhapususer(){
      axios.delete('http://127.0.0.1:8000/api/deleteuser/'+this.detaildatadialoguser.id).then(respon =>{
       console.log(respon)
        alert('berhasil hapus')
        })
        this.alluser.splice(this.editedIndex, 1)
        this.closeDeleteuser()

  },
  closeDeleteuser () {
        this.dialogDeleteuser = false
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        })
      },



      getalltoko(){
      axios.get('http://127.0.0.1:8000/api/getalltoko').then(respon=>{
        console.log(respon)
        this.alltoko =respon.data
      })
    },
    hapustoko (item) {
        this.editedIndex = this.alluser.indexOf(item)
        this.detaildatadialogtoko = Object.assign({}, item)
        this.dialogDeletetoko = true
        console.log(item)
      },
    confirmhapustoko(){
      axios.delete('http://127.0.0.1:8000/api/hapustoko/'+this.detaildatadialogtoko.toko_id).then(respon =>{
       console.log(respon)
        alert('berhasil hapus')
        })
        this.alltoko.splice(this.editedIndex, 1)
        this.closeDeletetoko()

  },
  closeDeletetoko () {
        this.dialogDeletetoko = false
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        })
      },


  },
  created() {
    this.getalluser()
    this.getalltoko()
  },
}
</script>

<style>
.contact {
  background-color: #2f432d;
  padding: 5px 0px 7px 154px;
}
.home-container {
  padding: 0px 123px;
}
.f24sb {
  padding-top: 15px;
  font-weight: 600;
  font-size: 24px;
  line-height: 36px;
}
.content {
  display: flex;
  gap: 38px;
}
.sub-title {
  font-family: "Poppins", sans-serif;
  font-weight: 700;
  font-size: 24px;
}
.menu {
  font-family: "Poppins", sans-serif;
  font-weight: 500;
  font-size: 20px;
}
.logout {
  margin-top: 570px;
  font-family: "Poppins", sans-serif;
  font-weight: 500;

  font-size: 20px;
}
.pembatas {
  border-left: 8px solid #d9d9d9;
  border-radius: 20px;
  height: 750px;
  margin-right: 10px;
  margin-left: 17px;
}
</style>
