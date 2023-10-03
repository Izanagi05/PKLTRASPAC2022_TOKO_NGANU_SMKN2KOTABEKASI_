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
          class="text-capitalize px-8 mb-6 text-body-1 font-weight-medium rounded-pill white--text"
          color="#4c60af"
          @click="tambahfoto()"
          >Tambah foto barang</v-btn
        >
      </div>
      <v-data-table
        data-app
        :headers="headers"
        :items="fotobarang"
        class="px-15"
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
      fotobarang: [],
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
      },
      defaultItem: {
        file: "",
      },
      fotoTambah: null,
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
  methods: {
    getfoto() {
      axios
        .get("http://127.0.0.1:8000/api/getfotobarang/" + this.prm.foto_barang)
        .then((respon) => {
          this.fotobarang = respon.data?.data;
        });
    },
    closeadd() {
      this.$nextTick(() => {
        this.detaildatadialog = Object.assign({}, this.defaultItem);
      });
      this.fotoTambah = null;
      this.prev = null;
      this.dialogadd = false;
    },
    upload(foto) {
      let prv = foto.target.files[0];
      this.preview = URL.createObjectURL(prv);
      this.filefoto = prv;
    },
    uploadTambah(foto) {
      let prv = foto.target.files[0];
      this.prev = URL.createObjectURL(prv);
      this.fotoTambah = prv;
    },
    tambahfoto() {
      this.dialogadd = true;
    },
    konfirmtambahfoto() {
      let foto = new FormData();
      foto.append("file", this.fotoTambah);
      axios
        .post(
          "http://127.0.0.1:8000/api/createfotobarang/" + this.prm.foto_barang,
          foto
        )
        .then((respon) => {
          console.log(respon);

          this.$toasted.success("Berhasil tambah foto barang", {
            position: "top-right",
            className: "edit-toast",
            duration: 3000,
          });
        });
      this.getfoto();
      this.fotobarang.push(this.detaildatadialog);
      this.closeadd();
    },

    ubahfoto(item) {
      this.indexnya = this.fotobarang.indexOf(item);
      this.detaildatadialog = Object.assign({}, item);
      this.forid = item.foto_barang_id;
      this.dialogedit = true;
      this.editdatafoto = Object.assign({}, item);
    },
    closeedit() {
      this.$nextTick(() => {
        this.detaildatadialog = Object.assign({}, this.defaultItem);
      });
      this.filefoto = null;
      this.preview = null;
      this.dialogedit = false;
    },
    updatefoto() {
      let foto = new FormData();
      if (this.filefoto) {
        console.log("0");
        foto.append("file", this.filefoto);
      } else {
        console.log("1");
        foto.append("file", this.editdatafoto.file);
      }
      axios
        .post("http://127.0.0.1:8000/api/updatefotobarang/" + this.forid, foto)
        .then((respon) => {
          console.log(respon.data);
          this.$toasted.success("Berhasil ubah foto barang", {
            position: "top-right",
            className: "edit-toast",
            duration: 3000,
          });
        });
      Object.assign(this.fotobarang[this.indexnya], this.detaildatadialog);
      this.getfoto();
      this.dialogedit = false;
    },

    hapusfoto(ftbrg) {
      console.log(ftbrg);
      this.editedIndex = this.fotobarang.indexOf(ftbrg.foto_barang_id);
      this.detaildatadialog = Object.assign({}, ftbrg.foto_barang_id);
      this.ftbrgid = ftbrg.foto_barang_id;
      this.dialogDelete = true;
    },
    confirmhapusfoto() {
      axios
        .delete("http://127.0.0.1:8000/api/deletefotobarang/" + this.ftbrgid)
        .then((respon) => {
          console.log(respon);
          this.$toasted.success("Berhasil hapus foto barang", {
            position: "top-right",
            className: "edit-toast",
            duration: 3000,
          });
        });
      // this.fotobarang.splice(this.indexnya, 1)
      this.getfoto();
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
