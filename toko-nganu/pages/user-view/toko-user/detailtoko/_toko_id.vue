<template>
  <div>
    <Navbar />
    detail toko
<!-- {{prm.toko_id  }} -->

<v-dialog v-model="dialogDelete" max-width="500px">
          <v-card>
            <v-card-title class="text-h5">Yakin ingin menghapus?</v-card-title>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue-darken-1" variant="text" @click="closeDelete">Cancel</v-btn>
              <v-btn color="blue-darken-1" variant="text" @click="confirmhapusbarang">OK</v-btn>
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
<v-text-field type="text" v-model="detaildatadialog.deskripsi"  label="deskripsi" outline></v-text-field>
<v-card-actions >
<v-btn @click="closeedit()" style="margin-right:20px;background:white;color:black;">Close</v-btn>
<v-btn @click="updatebarang()" style="background: #4caf50;color:white;" >Ubah</v-btn>
</v-card-actions>
</v-container>
</v-card>
</v-dialog>

    <v-data-table
    :headers="headers"
    :items="Toko"
    >

    <template v-slot:[`item.aksi`]="{ item }">
                    <v-btn class="mx-2"  fab small  @click="ubahbarang(item)" style="margin:15px 15px 15px 0px;">
                        <v-icon dark >mdi-pencil</v-icon>
                    </v-btn>
                    <v-btn class="mx-2"  fab small  @click="detailbarang(item)" style="margin:15px 15px 15px 0px;">
                        <v-icon dark >mdi-magnify</v-icon>
                    </v-btn>
                    <v-btn class="mx-2"   small  @click="detailfotobarang(item)" style="margin:15px 15px 15px 0px;">
                        info foto barang
                    </v-btn>
          <v-btn class="mx-2" fab small  @click="hapusbarang(item)" style="background:#FF2A30;">
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
</template>
<script>
import axios from 'axios';
export default {

  middleware:'middlewareku',
  data() {
    return {
      prm:this.$route.params,
      dialogedit:false,
      dialogDelete:false,
      Toko:[],
      barangtoko:null,
      headers:[

      {text:'Nama Barang', value:'nama'},
      {text:'Nama Barang', value:'deskripsi'},
      {text:'Aksi', value:'aksi'},
      ],
      detaildatadialog:{
       barang_id:'',
       nama:'',
      deskripsi:'',
     },
     defaultItem:{
      nama:'',
      deskripsi:'',
    },


      // Toko:null,
    }
  },
  methods: {
    getbarang(){
      axios.get('http://127.0.0.1:8000/api/getbarang/'+this.prm.toko_id).then(respon=>{
        this.Toko = respon.data
      })
    },
    detailbarang(item){
    this.$router.push(`/user-view/toko-user/detailtoko/detailbarang/varianbarang/${item.barang_id}` )
   },
    detailfotobarang(item){
    this.$router.push(`/user-view/toko-user/detailtoko/detailbarang/fotobarang/${item.barang_id}` )
   },
    ubahbarang(item){
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
    updatebarang(){
      axios.post('http://127.0.0.1:8000/api/updatebarang/'+this.detaildatadialog.barang_id, this.detaildatadialog).then(respon=>{
        console.log(respon.data)
      })
      Object.assign(this.Toko[this.indexnya], this.detaildatadialog)
    this.dialogedit=false
    },

    hapusbarang (item) {
        this.editedIndex = this.Toko.indexOf(item)
        this.detaildatadialog = Object.assign({}, item)
        this.dialogDelete = true
      },
    confirmhapusbarang(){
      axios.delete('http://127.0.0.1:8000/api/deletebarang/'+this.detaildatadialog.barang_id).then(respon =>{
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
     const  tokoid = this.$cookies.get('cookieku')
    this.barangtoko = tokoid.data.id
    this.getbarang()
    },
}
</script>
