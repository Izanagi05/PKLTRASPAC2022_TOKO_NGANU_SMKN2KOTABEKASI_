<template>
  <div>
    <Navbar/>

    <div>


  <v-data-table data-app
  :headers="headers"
  :items="Toko"


       >
       <template v-slot:[`item.aksi`]="{ item }">
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
    <v-text-field type="text" v-model="detaildatadialog.logo"  label="logo" outline></v-text-field>
    <!-- <div></div> -->
    <v-card-actions >
    <v-btn @click="closeedit()" style="margin-right:20px;background:white;color:black;">Close</v-btn>
    <v-btn @click="updatetoko(item)" style="background: #4caf50;color:white;" >Ubah</v-btn>
  </v-card-actions>
</v-container>
    </v-card>
  </v-dialog>
          <v-btn class="mx-2" fab small  @click="klikdetail(item)" style="margin:15px 15px 15px 0px;">
                        <v-icon dark>mdi-eye</v-icon>
                    </v-btn>
                    <v-btn class="mx-2"  fab small  @click="ubahdata(item)" style="margin:15px 15px 15px 0px;">
                        <v-icon dark >mdi-pencil</v-icon>
                    </v-btn>
          <v-btn class="mx-2" fab small  @click="hapusdata(item)" style="background:#FF2A30;">
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
        dialogedit:false,
        cari:null,
        nama:null,
        tokouser:null,
        Toko:[],
        UbahToko:null,

        datatoko: [],
     dialogdetail: false,
     dialogedit: false,
     indexnya: -1,
     headers: [
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
       nama:'',
      alamat:'',
      no_telepon:'',
      deskripsi:'',
      logo:''
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
      axios.get('http://127.0.0.1:8000/api/getbarang/'+this.tokouser).then(respon=>{
        this.Toko = respon.data
      })
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
    updatetoko(item){
      axios.post('http://127.0.0.1:8000/api/updatetoko/'+item, this.detaildatadialog).then(respon=>{
        console.log(respon.data)
      })
      Object.assign(this.Toko[this.indexnya], this.detaildatadialog)
this.dialogedit=false
    }
  },

  created(){
     const  userid = this.$cookies.get('cookieku')
    this.tokouser = userid.data.id
    this.gettoko()
    },

};
</script>
