<template>
  <div>
    <Navbar />
    detail foto



<v-dialog v-model="dialogDelete" max-width="500px">
          <v-card>
            <v-card-title class="text-h5">Yakin ingin menghapus?</v-card-title>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue-darken-1" fotot="text" @click="closeDelete">Cancel</v-btn>
              <v-btn color="blue-darken-1" fotot="text" @click="confirmhapusfoto">OK</v-btn>
              <v-spacer></v-spacer>
            </v-card-actions>
          </v-card>
</v-dialog>

<v-dialog v-model="dialogedit"   max-width="700" persistent transition="dialog-bottom-transition">
<v-card class="kartu " light style="padding:0px;color:black;border:solid 3px #4caf50;">
<div style="background:#4caf50;padding:10px 30px;color:white;">
<h1>Ubah data foto </h1>
</div>
<v-container style="padding:30px;">
  <input type="file" v-on:change="upload"  label="Name" />

<v-card-actions >
<v-btn @click="closeedit()" style="margin-right:20px;background:white;color:black;">Close</v-btn>
<v-btn @click="updatefoto()" style="background: #4caf50;color:white;" >Ubah</v-btn>
</v-card-actions>
</v-container>
</v-card>
</v-dialog>
<div >
  <v-data-table data-app
  :headers="headers"
    :items="fotobarang"
    >
    <template v-slot:top>
      <v-dialog v-model="dialogadd"   max-width="700" persistent transition="dialog-bottom-transition">
      <template
      v-slot:activator="{on, attrs}"
      >
        <v-btn
        v-bind="attrs"
        v-on="on"
        color="primary" @click=" tambahfoto()">Tambah foto barang</v-btn>
      </template>
    <v-card class="kartu " light style="padding:0px;color:black;border:solid 3px blueviolet;">
    <div style="background:blueviolet;padding:10px 30px;color:white;">
    <h1>Tambah data foto</h1>
    </div>
    <v-container style="padding:30px;">
    <input type="file" v-on:change="upload"  label="Name" />
    <v-card-actions >
    <v-btn @click="closeadd()" style="margin-right:20px;background:white;color:black;">Close</v-btn>
    <v-btn @click="konfirmtambahfoto()" style="background: blueviolet;color:white;" >tambah</v-btn>
    </v-card-actions>
    </v-container>
    </v-card>
    </v-dialog>
    </template>

    <template v-slot:[`item.aksi`]="{ item }">
                    <v-btn class="mx-2"  fab small  @click="ubahfoto(item)" style="margin:15px 15px 15px 0px;">
                        <v-icon dark >mdi-pencil</v-icon>
                    </v-btn>
                    <v-btn class="mx-2" fab small  @click="hapusfoto(item)" style="background:#FF2A30;">
                      <v-icon dark>mdi-delete</v-icon>
                    </v-btn>
                  </template>
                  <template v-slot:[`item.nomor`]="{ index }">
                  <div >
                      {{ index+1 }}
                  </div>
                  </template>

    </v-data-table>
  </div>
</div>
</template>
<script>
import axios from 'axios';
export default {

  middleware:'middlewareku',
  data() {
    return {
      prm:this.$route.params,
      dialogadd:false,
      dialogedit:false,
      dialogDelete:false,
      fotobarang:[],
      editedIndex:0,
      idfotobarang:null,
      filefoto:null,
      ftbrgid:null,
      headers:[

      {text:'Nama', value:'file'},
      {text:'Nama', value:'aksi'},
      ],
      forid:{
        foto_barang_id:'',
      },
      detaildatadialog:{
       foto_barang_id:'',
       file:'',

     },
     defaultItem:{
      file:'',

    },
    }
  },
  methods: {
    getfoto(){
      axios.get('http://127.0.0.1:8000/api/getfotobarang/'+this.prm.foto_barang).then(respon=>{
        this.fotobarang = respon.data
      })
    },
    closeadd(){
     this.$nextTick(() => {
           this.detaildatadialog = Object.assign({}, this.defaultItem)
         })
     this.dialogadd=false
   },
   upload(foto){
    let prv = foto.target.files[0];
      this.preview= URL.createObjectURL(prv)
      this.filefoto=prv
   },
    tambahfoto(){
      this.dialogadd=true;

    },
    konfirmtambahfoto(){
      let foto= new FormData()
      foto.append('file', this.filefoto)
      axios.post('http://127.0.0.1:8000/api/createfotobarang/'+this.prm.foto_barang, foto ).then(respon=>{
        console.log(respon)
        location.reload()
      })
      this.fotobarang.push(this.detaildatadialog)
      this.closeadd()
    },

    ubahfoto(item){
    this.indexnya = this.fotobarang.indexOf(item)
    this.detaildatadialog = Object.assign({}, item)
    this.forid = Object.assign({}, item)
     this.dialogedit= true
   },
   closeedit(){
    this.$nextTick(() => {
          this.detaildatadialog = Object.assign({}, this.defaultItem)
        })
    this.dialogedit=false
  },
    updatefoto(){
      axios.post('http://127.0.0.1:8000/api/updatefotobarang/'+this.forid.foto_id, this.detaildatadialog).then(respon=>{
        console.log(respon.data)
      })
      Object.assign(this.fotobarang[this.indexnya], this.detaildatadialog)
    this.dialogedit=false
    },

    hapusfoto (ftbrg) {
      console.log(ftbrg)
        this.editedIndex = this.fotobarang.indexOf(ftbrg.foto_barang_id)
        this.detaildatadialog = Object.assign({}, ftbrg.foto_barang_id)
        this.ftbrgid =  ftbrg.foto_barang_id
        this.dialogDelete = true
      },
    confirmhapusfoto(){
      axios.delete('http://127.0.0.1:8000/api/deletefotobarang/'+this.ftbrgid).then(respon =>{
       console.log(respon)
        alert('berhasil hapus')
        location.reload()
        })
        // this.fotobarang.splice(this.indexnya, 1)
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
     const  barangid = this.$cookies.get('cookieku')
    this.idfotobarang = barangid.data.id
    this.getfoto()
    },
}
</script>
