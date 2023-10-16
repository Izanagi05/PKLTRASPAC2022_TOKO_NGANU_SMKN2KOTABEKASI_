<template>
  <div>
    <div
      class="judul pb-4 pt-2 font-weight-bold"
      style="font-family: 'Poppins', sans-serif; font-size: 30px"
    >
      <center>Detail Foto Barang</center>
    </div>
    <DialogDelete
      :dialogDelete="dialogDelete"
      :confirmhapus="confirmhapusfoto"
      :closeDelete="closeDelete"
    />
    <DialogUpdate
      :dialogedit="dialogedit"
      item="Foto Barang"
      :upload="upload"
      :closeedit="closeedit"
      :updateedit="updatefoto"
    />
    <DialogTambah
      :dialogtambah="dialogadd"
      item="Foto Barang"
      :prev="prev"
      :upload="uploadTambah"
      :closetambah="closeadd"
      :konfirmtambah="konfirmtambahfoto"
    />
    <div>
      <div class="btn-add pb-6 pl-4">
        <v-btn
          class="text-capitalize px-8 mb-6 text-body-1 font-weight-medium rounded-lg white--text"
          color="#2f432d"
          @click="tambahfoto()"
          >Tambah foto barang</v-btn
        >
      </div>
      <div  style="height: 80vh; overflow-y: scroll;" class="rounded-lg">
      <v-data-table
        data-app
        :headers="headers"
        :items="fotobarang"
        class=""
      >
        <template v-slot:[`item.file`]="{ item }">
          <v-img
            width="200"
            :src="'http://127.0.0.1:8000/storage/' + item.file"
          >
          </v-img>
        </template>
        <template v-slot:[`item.aksi`]="{ item }">
          <v-btn
            class="mx-2 white--text btn-crkuup"
            fab
            small
            @click="ubahfoto(item)"
          >
            <v-icon dark>mdi-pencil</v-icon>
          </v-btn>
          <v-btn
            class="mx-2 white--text btn-crkuhap"
            fab
            small
            @click="hapusfoto(item)"
          >
            <v-icon dark>mdi-delete</v-icon>
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
  </div>
</template>
<script>
import axios from "axios";
export default {
  layout: 'UserView',
  middleware: "middlewareku",
  data() {
    return {
      prm: this.$route.params,
      dialogadd: false,
      dialogedit: false,
      dialogDelete: false,
      // fotobarang: [],
      editedIndex: 0,
      idfotobarang: null,
      filefoto: null,
      ftbrgid: null,
      headers: [
        { text: "Foto Barang", value: "file" },
        { text: "Aksi", value: "aksi" },
      ],
      forid: {
        foto_barang_id: "",
      },

      editdatafoto: {
        file: "",
      },
      detaildatadialog: {
        foto_barang_id: "",
        file: "",
        fotolama: "",
      },
      defaultItem: {
        foto_barang_id: "",
        file: "",
        fotolama: "",
      },
      fotoTambah: {
        barang_id:"",
        file:"",
        fotolama:""
      },
      prev: null,
      preview: null,
      rules: [
        (value) => {
          return (
            !value ||
            !value.length ||
            value[0].size < 2000000 ||
            "Foto tidak bisa lebih dari 2 MB!"
          );
        },
      ],
    };
  },
  computed:{
    fotobarang(){
      return this.$store.state.foto_barang.alldatafotobarang
    }
  },
  methods: {
    getfoto() {
        this.$store.dispatch('foto_barang/getdatafotobarang',  this.prm.foto_barang)
    },
    closeadd() {
      this.$nextTick(() => {
        this.detaildatadialog = Object.assign({}, this.defaultItem);
      });
      this.fotoTambah = Object.assign({}, this.defaultItem);
      this.fotoTambah.file = null;
      this.fotoTambah.barang_id = null;
      this.prev = null;
      this.dialogadd = false;
    },
    uploadTambah(foto) {
      let prv = foto.target.files[0];
      this.prev = URL.createObjectURL(prv);
      this.fotoTambah.file = prv;
    },
    tambahfoto() {
      this.dialogadd = true;
    },
    konfirmtambahfoto() {
      this.fotoTambah.barang_id = this.prm.foto_barang
      // let foto = new FormData();
      // foto.append("file", this.fotoTambah.file);
      // axios
      //   .post(
      //     "http://127.0.0.1:8000/api/createfotobarang/" +this.fotoTambah,
      //     foto
      //   )
      //   .then((respon) => {
      //     console.log(respon);

      //     this.$toasted.success("Berhasil tambah foto barang", {
      //       position: "top-right",
      //       className: "edit-toast",
      //       duration: 3000,
      //     });
        // });
        this.$store.dispatch('foto_barang/tambahdata',  this.fotoTambah)
        // this.getfoto();
        console.log(this.fotoTambah)
        // this.fotobarang.push(this.detaildatadialog);
      // this.closeadd();
    },

    upload(foto) {
      let prv = foto.target.files[0];
      this.preview = URL.createObjectURL(prv);
      this.detaildatadialog.file = prv;
    },
    ubahfoto(item) {
      this.indexnya = this.fotobarang.indexOf(item);
      this.detaildatadialog = Object.assign({}, item);
      this.detaildatadialog.foto_barang_id = item.foto_barang_id;
      this.dialogedit = true;
      // this.editdatafoto = ;
      // this.detaildatadialog.fotolama=Object.assign({}, item.file)
    },
    closeedit() {
      this.$nextTick(() => {
        this.detaildatadialog = Object.assign({}, this.defaultItem);
        this.fot = Object.assign({}, this.defaultItem);
      });
      this.filefoto = null;
      this.preview = null;
      this.dialogedit = false;
    },
    updatefoto() {
      // let foto = new FormData();
      // if (this.filefoto.file) {
      //   console.log("0");
      //   foto.append("file", this.filefoto.file);
      // } else {
      //   console.log("1");
      //   foto.append("file", this.filefoto.fotolama);
      // }
      // axios
      //   .post("http://127.0.0.1:8000/api/updatefotobarang/" + this.forid, foto)
      //   .then((respon) => {
      //     console.log(respon.data);
      //     this.$toasted.success("Berhasil ubah foto barang", {
      //       position: "top-right",
      //       className: "edit-toast",
      //       duration: 3000,
      //     });
      //   });
      // Object.assign(this.fotobarang[this.indexnya], this.detaildatadialog);
      // this.getfoto();
      this.$store.dispatch('foto_barang/ubahdata',  this.detaildatadialog)
      console.log(this.detaildatadialog)
      this.closeedit()
    },

    hapusfoto(ftbrg) {
      console.log(ftbrg);
      this.editedIndex = this.fotobarang.indexOf(ftbrg.foto_barang_id);
      this.detaildatadialog = Object.assign({}, ftbrg.foto_barang_id);
      this.ftbrgid = ftbrg.foto_barang_id;
      this.dialogDelete = true;
    },
    confirmhapusfoto() {
        this.$store.dispatch('foto_barang/hapusdata',  this.ftbrgid)
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
    this.idfotobarang = barangid.data.id;
    this.getfoto();
  },
};
</script>
<style scoped>
.edit-toast {
  background: green;
  color: white;
  padding: 10px;
  border-radius: 20px;
}
</style>
