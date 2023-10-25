<template>
  <div>
    <div class="pb-5 font-weight-medium text-h6">Detail Varian</div>
    <DialogTambah
      :dialogtambah="dialogadd"
      item="Varian"
      :prev="prev"
      :closetambah="closeadd"
      :upload="uploadTambah"
      :detaildatadialog="detaildatadialog"
      :konfirmtambah="konfirmtambahvarian"
    />
    <DialogDelete
      :dialogDelete="dialogDelete"
      :confirmhapus="confirmhapusvarian"
      :closeDelete="closeDelete"
    />
    <DialogUpdate
      :dialogedit="dialogedit"
      item="Varian "
      :detaildatadialog="detaildatadialog"
      :closeedit="closeedit"
      :upload="uploadupdate"
      :updateedit="updatevarian"
    />
    <div class="pb-6">
      <v-btn
        class="text-capitalize px-8 mb-6 text-body-1 font-weight-medium rounded-lg white--text"
        color="#2f432d"
        @click="tambahvarian()"
        >Tambah varian barang</v-btn
      >
    </div>
     <div  style="height: 80vh; overflow-y: scroll;" class="rounded-lg">

    <v-data-table data-app class="" :headers="headers" :items="barang">
      <template v-slot:[`item.foto_barang_varian`]="{ item }">
        <div class="image-container3 rounded-lg d-flex justify-center align-center">
          <v-img
          class="rounded-lg"
            width="80%"
            height="80%"
            :src="'http://127.0.0.1:8000/storage/' + item.foto_barang_varian"
          >
          </v-img>
        </div>
      </template>
      <template v-slot:[`item.aksi`]="{ item }">
        <v-btn
          class="mx-2 "
          icon
          color="#4caf50"
          small
          @click="ubahvarian(item)"
        >
          <v-icon>mdi-pencil</v-icon>
        </v-btn>
        <v-btn
          class="mx-2 "
          icon
          color="#ff5252"
          small
          @click="hapusvarian(item)"
        >
          <v-icon>mdi-delete</v-icon>
        </v-btn>
      </template>
      <template v-slot:[`item.nomor`]="{ index }">
        <div>
          {{ index + 1 }}
        </div>
      </template>
    </v-data-table>
  </div>
  </div>
</template>
<script>
import axios from "axios";
import { mapActions, mapState, mapGetters } from 'vuex';
export default {
  layout: "UserView",
  middleware: "middlewareku",
  data() {
    return {
      prm: this.$route.params,
      dialogadd: false,
      dialogedit: false,
      dialogDelete: false,
      // barang: [],
      varianbarang: null,
      headers: [
        { text: "Nama varian", value: "nama" },
        { text: "harga", value: "harga" },
        { text: "stok", value: "stok" },
        { text: "foto", value: "foto_barang_varian" },
        { text: "Aksi", value: "aksi" },
      ],
      varid: {
        varian_id: "",
      },
      detaildatadialog: {
        varian_id: null,
        fotosementara: null,
        idbrg: null,
        nama: null,
        harga: null,
        stok: null,
        foto_barang_varian: null,
      },
      defaultItem: {
        varian_id: null,
        fotosementara: null,
        idbrg: null,
        nama: null,
        harga: null,
        stok: null,
        foto_barang_varian: null,
      },
      prev: null,
      preview: null,
      filefoto: null,
    };
  },
  computed:{
    barang(){
      return this.$store.state.varian.alldatabarang
    },
    ...mapGetters('varian', ['getdata','getresp']),
  },
  methods: {
    ...mapActions(['getdatavarian', 'tambahdata', 'hapusdata']),
    // getvarian() {

    // //   this.$store.dispatch('varian/getdatavarian', this.prm.barang_id )
    // // this.barang=  this.getdata
    // },
    closeadd() {
      this.$nextTick(() => {
        this.detaildatadialog = Object.assign({}, this.defaultItem);
      });
      this.dialogadd = false;
    },
    tambahvarian() {
      this.dialogadd = true;
    },
    uploadTambah(foto) {
      let prv = foto.target.files[0];
      this.prev = URL.createObjectURL(prv);
      this.fotoTambah = prv;
      this.detaildatadialog.foto_barang_varian = prv;
    },
    konfirmtambahvarian() {

      this.detaildatadialog.idbrg=this.prm.barang_id;
      this.$store.dispatch('varian/tambahdata', this.detaildatadialog )
      console.log(this.getresp)
      this.$toast.success("Berhasil tambah");
      this.barang
      this.closeadd();
    },
    uploadupdate(foto) {
      let prv = foto.target.files[0];
      this.preview = URL.createObjectURL(prv);
      this.detaildatadialog.fotosementara = prv;
    },
    ubahvarian(item) {
      this.indexnya = this.barang.indexOf(item);
      this.detaildatadialog = Object.assign({}, item);
      this.varid = Object.assign({}, item);
      this.dialogedit = true;
    },
    closeedit() {
      this.$nextTick(() => {
        this.detaildatadialog = Object.assign({}, this.defaultItem);
      });
      this.dialogedit = false;
    },
    updatevarian() {
      this.detaildatadialog.varian_id=this.varid.varian_id
      this.$store.dispatch('varian/ubahdata', this.detaildatadialog )
      this.dialogedit = false;
      this.detaildatadialog = Object.assign({}, this.defaultItem);
    },

    hapusvarian(item) {
      this.editedIndex = this.barang.indexOf(item);
      this.detaildatadialog = Object.assign({}, item);
      this.dialogDelete = true;
    },
    confirmhapusvarian() {

      // this.barang.splice(this.editedIndex, 1);
      this.$store.dispatch('varian/hapusdata', this.detaildatadialog.varian_id )
      this.$store.dispatch('varian/getdatavarian', this.prm.barang_id )
      this.closeDelete();
    },
    closeDelete() {
      this.dialogDelete = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },
  },

  created() {
    const barangid = this.$cookies.get("cookieku");
    this.varianbarang = barangid.data.id;
    // this.getvarian();
    this.$store.dispatch('varian/getdatavarian', this.prm.barang_id )
    this.barang
  },
};
</script >

<style scoped>
.image-container3 {
  width: 100px;
  height: 100px;
  overflow: hidden;
}

.image-container3 img {
  object-fit: cover;
  object-position: center;
}
</style>
