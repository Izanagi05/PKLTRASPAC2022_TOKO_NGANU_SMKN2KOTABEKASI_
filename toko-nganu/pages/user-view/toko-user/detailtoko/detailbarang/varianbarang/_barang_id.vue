<template>
  <div>
    <Navbar />


    <div class="pl-15 pb-5 font-weight-medium">Detail Varian</div>
<v-dialog v-model="dialogDelete" max-width="500px">
          <v-card>
            <v-card-title class="text-h5">Yakin ingin menghapus?</v-card-title>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue-darken-1" variant="text" @click="closeDelete">Cancel</v-btn>
              <v-btn color="blue-darken-1" variant="text" @click="confirmhapusvarian">OK</v-btn>
              <v-spacer></v-spacer>
            </v-card-actions>
          </v-card>
</v-dialog>

<v-dialog v-model="dialogedit"   max-width="700" persistent transition="dialog-bottom-transition">
<v-card class="kartu " light style="padding:0px;color:black;border:solid 3px #2f432d;">
<div style="background:#2f432d;padding:10px 30px;color:white;">
<h1>Ubah data varian {{ detaildatadialog.nama }}</h1>
</div>
<v-container style="padding:30px;">

<v-text-field type="text" v-model="detaildatadialog.nama"  label="Name" outline></v-text-field>
<v-text-field type="number" v-model="detaildatadialog.harga"  label="harga" outline></v-text-field>
<v-text-field type="number" v-model="detaildatadialog.stok"  label="stok" outline></v-text-field>
<v-card-actions >
<v-btn @click="closeedit()" style="margin-right:20px;background:white;color:black;">Close</v-btn>
<v-btn @click="updatevarian()" style="background: #2f432d;color:white;" >Ubah</v-btn>
</v-card-actions>
</v-container>
</v-card>
</v-dialog>
    <v-data-table data-app class="px-15"
    :headers="headers"
    :items="barang"
    >
    <template v-slot:top>
      <v-dialog v-model="dialogadd"   max-width="700" persistent transition="dialog-bottom-transition">
      <template
      v-slot:activator="{on, attrs}"
      >



        <v-btn v-bind="attrs"
        v-on="on" class="btn-add rounded-pill white--text" color="#2f432d" @click="tambahvarian()"
            >Tambah varian barang</v-btn
          >

      </template>
    <v-card class="kartu " light style="padding:0px;color:black;border:solid 3px #2f432d;">
    <div style="background:#2f432d;padding:10px 30px;color:white;">
    <h1>Tambah data varian</h1>
    </div>
    <v-container style="padding:30px;">

    <v-text-field type="text" v-model="detaildatadialog.nama"  label="Name" outline></v-text-field>
    <v-text-field type="number" v-model="detaildatadialog.harga"  label="harga" outline></v-text-field>
    <v-text-field type="number" v-model="detaildatadialog.stok"  label="stok" outline></v-text-field>
    <v-card-actions >
    <v-btn @click="closeadd()" style="margin-right:20px;background:white;color:black;">Close</v-btn>
    <v-btn @click="konfirmtambahvarian()" style="background: #2f432d;color:white;" >tambah</v-btn>
    </v-card-actions>
    </v-container>
    </v-card>
    </v-dialog>
    </template>

    <template v-slot:[`item.aksi`]="{ item }">
                    <v-btn class="mx-2"  fab small  @click="ubahvarian(item)" style="margin:15px 15px 15px 0px;">
                        <v-icon dark >mdi-pencil</v-icon>
                    </v-btn>
          <v-btn class="mx-2" fab small  @click="hapusvarian(item)" style="background:#FF2A30;">
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
      dialogadd:false,
      dialogedit:false,
      dialogDelete:false,
      barang:[],
      varianbarang:null,
      headers:[

      {text:'Nama varian', value:'nama'},
      {text:'harga', value:'harga'},
      {text:'stok', value:'stok'},
      {text:'Aksi', value:'aksi'},
      ],
      varid:{
        varian_id:'',
      },
      detaildatadialog:{
       nama:'',
      harga:'',
      stok:'',
     },
     defaultItem:{
      nama:'',
      harga:'',
      stok:'',
    },
    }
  },
  methods: {
    getvarian(){
      axios.get('http://127.0.0.1:8000/api/getvarianbarang/'+this.prm.barang_id).then(respon=>{
        this.barang = respon.data
      })
    },
    closeadd(){
     this.$nextTick(() => {
           this.detaildatadialog = Object.assign({}, this.defaultItem)
         })
     this.dialogadd=false
   },
    tambahvarian(){
      this.dialogadd=true;
    },
    konfirmtambahvarian(){
      axios.post('http://127.0.0.1:8000/api/createvarianbarang/'+this.prm.barang_id, this.detaildatadialog ).then(respon=>{
        console.log(respon)
        // this.barang.push(this.detaildatadialog)
        location.reload()
      })
      this.closeadd()
    },

    ubahvarian(item){
    this.indexnya = this.barang.indexOf(item)
    this.detaildatadialog = Object.assign({}, item)
    this.varid = Object.assign({}, item)
     this.dialogedit= true
   },
   closeedit(){
    this.$nextTick(() => {
          this.detaildatadialog = Object.assign({}, this.defaultItem)
        })
    this.dialogedit=false
  },
    updatevarian(){
      axios.post('http://127.0.0.1:8000/api/updatevarianbarang/'+this.varid.varian_id, this.detaildatadialog).then(respon=>{
        console.log(respon.data)
        location.reload()
      })
      // Object.assign(this.barang[this.indexnya], this.detaildatadialog)
    this.dialogedit=false
    },

    hapusvarian (item) {
        this.editedIndex = this.barang.indexOf(item)
        this.detaildatadialog = Object.assign({}, item)
        this.dialogDelete = true
      },
    confirmhapusvarian(){
      axios.delete('http://127.0.0.1:8000/api/deletevarianbarang/'+this.detaildatadialog.varian_id).then(respon =>{
       console.log(respon)
        alert('berhasil hapus')
        location.reload()
        })
        this.barang.splice(this.editedIndex, 1)
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
    this.varianbarang = barangid.data.id
    this.getvarian()
    },
}
</script>
