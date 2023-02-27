<template>
  <div>
    <Navbar/>

    <div>
      <nuxt-link to="/user-view/toko-user/tambah-barang"><v-btn color="primary">Tambah barang</v-btn></nuxt-link>
<v-dialog v-model="dialogDelete" max-width="500px">
          <v-card>
            <v-card-title class="text-h5">Yakin ingin menghapus?</v-card-title>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue-darken-1" variant="text" @click="closeDelete">Cancel</v-btn>
              <v-btn color="blue-darken-1" variant="text" @click="confirmhapustoko">OK</v-btn>
              <v-spacer></v-spacer>
            </v-card-actions>
          </v-card>
</v-dialog>

<v-dialog v-model="dialogedit"   max-width="700" persistent transition="dialog-bottom-transition">
<v-card class="kartu " light style="padding:0px;color:black;border:solid 3px #4caf50;">
<div style="background:#4caf50;padding:10px 30px;color:white;">
<h1>Ubah data</h1>
</div>
<v-container style="padding:30px;">

<v-text-field type="text" v-model="detaildatadialog.nama"  label="Name" outline></v-text-field>
<v-text-field type="text" v-model="detaildatadialog.alamat" label="alamat" outline></v-text-field>
<v-text-field type="text" v-model="detaildatadialog.no_telepon"  label="no telepon" outline></v-text-field>
<v-text-field type="text" v-model="detaildatadialog.deskripsi"  label="deskripsi" outline></v-text-field>
<input type="file"  v-on:change="upload" label="logo" />
<!-- <div></div> -->
<v-card-actions >
<v-btn @click="closeedit()" style="margin-right:20px;background:white;color:black;">Close</v-btn>
<v-btn @click="updatetoko()" style="background: #4caf50;color:white;" >Ubah</v-btn>
</v-card-actions>
</v-container>
</v-card>
</v-dialog>
<v-dialog v-model="dialogdetail"   max-width="700" persistent transition="dialog-bottom-transition">
    <v-card class="kartu " light style="padding:0px;color:black;border: #fb8c00 solid 3px;">
      <div style="background:#fb8c00;padding:10px 30px;color:white;">
<h1>Detail</h1>
</div>
    <v-container style="padding:30px;">
    <div style="margin:20px;">
      <v-row>
        <v-col cols="5">
          <h3>Nama: {{ detaildatadialog.nama }}</h3>
        </v-col>
        <v-col>
        <h3>Alamat: {{ detaildatadialog.alamat }}</h3>
      </v-col>
    </v-row>
    <v-row>
      <v-col cols="5">

        <h3>No Telepon: {{ detaildatadialog.no_telepon }}</h3>
      </v-col>
      <v-col>
        <h3>Deskripsi: {{ detaildatadialog.deskripsi }}</h3>
      </v-col>
    </v-row>
    <v-row>
      <v-col>
        <h3>Logo: {{ detaildatadialog.logo }}</h3>
      </v-col>
      <v-col>
        <p>Barang</p>
        <div v-for="(brgtoko, index) in detaildatadialog.barang" :key="index">
          <h3>Barang: {{ brgtoko.nama }}</h3>
          <h3>deskripsi: {{ brgtoko.deskripsi }}</h3>
        </div>
      </v-col>
    </v-row>
    <!-- <div></div> -->
  </div>
    <v-card-actions >
    <v-btn @click="closedetail()" style="background:#fb8c00;color:black;">Close</v-btn>
  </v-card-actions>
</v-container>
    </v-card>
  </v-dialog>
      <v-data-table data-app
  :headers="headers"
  :items="Toko"


  >

  <template v-slot:[`item.logo`]="{ item }">
        <v-img width="200"  :src="'http://127.0.0.1:8000/storage/'+item.logo">

        </v-img>
      </template>
  <template v-slot:[`item.aksi`]="{ item }">
    <v-btn class="mx-2" fab small  @click="klikdetail(item)" style="margin:15px 15px 15px 0px;">
                        <v-icon dark>mdi-eye</v-icon>
                    </v-btn>
    <v-btn class="mx-2" fab small  @click="detailbarang(item)" style="margin:15px 15px 15px 0px;">
                        <v-icon dark>mdi-magnify</v-icon>
                    </v-btn>
                    <v-btn class="mx-2"  fab small  @click="ubahdata(item)" style="margin:15px 15px 15px 0px;">
                        <v-icon dark >mdi-pencil</v-icon>
                    </v-btn>
          <v-btn class="mx-2" fab small  @click="hapustoko(item)" style="background:#FF2A30;">
                        <v-icon dark>mdi-delete</v-icon>
                    </v-btn>
                  </template>
                  <template v-slot:[`item.nomor`]="{ index }">
                  <div >
                      {{ index+1 }}
                  </div>
                  </template>
                </v-data-table>
      <v-container>

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
        dialogDelete:false,
        dialogedit:false,
        datafoto:null,
        cari:null,
        nama:null,
        tokouser:null,
        Toko:[],
        UbahToko:null,
        edittokoid:null,
        tess:18,

        datatoko: [],
     dialogdetail: false,
     dialogedit: false,
     indexnya: null,
     headers: [
      //  {text: 'Id Toko', align: 'start', value: 'toko_id'},
       {text: 'Nama Toko', align: 'start', value: 'nama'},
       {text: 'Alamat', align: 'start', value: 'alamat'},
       {text: 'NO Telepon', align: 'start', value: 'no_telepon'},
       {text: 'Deskripsi', align: 'start', value: 'deskripsi'},
       {text: 'Logo', align: 'start', value: 'logo'},
       {text: 'Aksi', align:'start', value: 'aksi', width:'300px'},
     ],
     dialoghapus:false,

    //  detaildatadialog: [],
     detaildatadialog:{
       toko_id:'',
       nama:'',
      alamat:'',
      no_telepon:'',
      deskripsi:'',
      logo:'',
      barang:''
     },
     defaultItem:{
      nama:'',
      alamat:'',
      no_telepon:'',
      deskripsi:'',
      logo:''
    },
      }
    },
  methods: {
    gettoko(){
      axios.get('http://127.0.0.1:8000/api/gettoko/'+this.tokouser).then(respon=>{
        this.Toko = respon.data
        this.edittokoid =respon.data.toko_id
      })
    },
    klikdetail(item){
     this.detaildatadialog = Object.assign({}, item)
     this.dialogdetail= true
   },
   detailbarang(item){
    this.$router.push(`/user-view/toko-user/detailtoko/${item.toko_id}` )
   },
   closedetail(){
    this.$nextTick(() => {
          this.detaildatadialog = Object.assign({}, this.defaultItem)
        })
    this.dialogdetail=false

  },

    ubahdata(item){
    this.indexnya = this.Toko.indexOf(item)
    this.detaildatadialog = Object.assign({}, item)
     this.dialogedit= true
   },
   closeedit(){
    this.$nextTick(() => {
          this.detaildatadialog = Object.assign({}, this.defaultItem)
        })
    this.dialogedit=false
  },
  upload(foto){
    let files = foto.target.files[0];
    this.datafoto = files;
    console.log(foto);
  },
    updatetoko(){
      let formData = new FormData()
    formData.append('logo', this.datafoto)
      axios.post('http://127.0.0.1:8000/api/updatetoko/'+this.detaildatadialog.toko_id, formData, {
            'content-type': 'multipart/form-data'
          });
      axios.post('http://127.0.0.1:8000/api/updatetoko/'+this.detaildatadialog.toko_id, this.detaildatadialog).then(respon=>{
        console.log(respon.data)
      })
      Object.assign(this.Toko[this.indexnya], this.detaildatadialog)
    this.dialogedit=false
    },

    hapustoko (item) {
        this.editedIndex = this.Toko.indexOf(item)
        this.detaildatadialog = Object.assign({}, item)
        this.dialogDelete = true
      },
    confirmhapustoko(){
      axios.delete('http://127.0.0.1:8000/api/hapustoko/'+this.detaildatadialog.toko_id).then(respon =>{
       console.log(respon)
        alert('berhasil hapus')
        })
        this.Toko.splice(this.editedIndex, 1)
        this.closeDelete()

  },
  closeDelete () {
        this.dialogDelete = false
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        })
      },
  },

  created(){
     const  userid = this.$cookies.get('cookieku')
    this.tokouser = userid.data.id
    this.gettoko()
    },

};
</script>
