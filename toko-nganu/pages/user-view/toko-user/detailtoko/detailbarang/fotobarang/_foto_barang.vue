<template>
  <div>
    <Navbar />
    <div class="judul pb-4 pt-2 font-weight-bold" style="font-family: 'Poppins', sans-serif; font-size: 30px">
      <center>Detail Foto Barang</center>
    </div>

    <v-dialog v-model="dialogDelete" max-width="500px">
      <v-card>
        <v-card-title class="text-h5">Yakin ingin menghapus?</v-card-title>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue-darken-1" fotot="text" @click="closeDelete">Kembali</v-btn>
          <v-btn color="blue-darken-1" fotot="text" @click="confirmhapusfoto">Ya</v-btn>
          <v-spacer></v-spacer>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <v-dialog v-model="dialogedit" max-width="700" persistent transition="dialog-bottom-transition">
      <v-card class="kartu" light style="padding: 0px; color: black; border: solid 2px #2f432d">
        <div style="background:#2f432d;padding:10px 30px;color:white;">
          <h1>Ubah data foto</h1>
        </div>
        <v-card-text style="padding: 30px">
          <div class="preview">
            <v-img v-if="preview" :src="preview" width="200px"></v-img>
          </div>
          <input accept="image/*" class="file-input pt-6" :rules="rules" type="file" placeholder="Pilih Foto"
            prepend-icon="mdi-camera" label="Pilih Foto" v-on:change="upload" />
        </v-card-text>
        <v-card-actions>
          <v-btn @click="closeedit()" style="margin-right: 20px; background: white; color: black">Kembali</v-btn>
          <v-btn @click="updatefoto()" style="background: #2f432d; color: white">Ubah</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <div>
      <v-data-table data-app :headers="headers" :items="fotobarang" class="px-15">
        <template v-slot:[`item.file`]="{ item }">
          <v-img width="200" :src="'http://127.0.0.1:8000/storage/' + item.file">
          </v-img>
        </template>
        <template v-slot:top>
          <v-dialog v-model="dialogadd" max-width="700" persistent transition="dialog-bottom-transition">

            <template v-slot:activator="{ on, attrs }">
              <div class="btn-add pb-6 pl-4">
                <v-btn class="btn-tambah rounded-pill px-15" v-bind="attrs" v-on="on"
                  style="background: #2f432d; color: white" @click="tambahfoto()">Tambah foto barang</v-btn>
              </div>
            </template>



            <v-card class="kartu" light style="padding: 0px; color: black; border: solid 2px #2f432d">
              <div style="background:#2f432d;padding:10px 30px;color:white;">
                <h1>Tambah data foto</h1>
              </div>
              <v-card-text style="padding: 30px">
                <div class="preview">
                  <v-img :src="prev" v-if="prev" width="200px"></v-img>
                </div>
                <input accept="image/*" class="file-input pt-6" :rules="rules" type="file" placeholder="Pilih Foto"
                  prepend-icon="mdi-camera" label="Pilih Foto" v-on:change="uploadTambah" />
              </v-card-text>
              <v-card-actions>
                <v-btn @click="closeadd()" style="margin-right: 20px; background: white; color: black">Kembali</v-btn>
                <v-btn @click="konfirmtambahfoto()" style="background: #2f432d; color: white">Tambah</v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </template>

        <template v-slot:[`item.aksi`]="{ item }">
          <v-btn class="mx-2" fab small @click="ubahfoto(item)" style="margin: 15px 15px 15px 0px">
            <v-icon dark>mdi-pencil</v-icon>
          </v-btn>
          <v-btn class="mx-2" fab small @click="hapusfoto(item)" style="background: #ff2a30">
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
          this.fotobarang = respon.data;
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

          location.reload();
          this.$toasted.show('Berhasil tambah foto barang', {
        theme: 'success',
        position: 'top-right',
        className: 'edit-toast',
        duration: 3000
      })
        });
      this.fotobarang.push(this.detaildatadialog);
      this.closeadd();
    },

    ubahfoto(item) {
      this.indexnya = this.fotobarang.indexOf(item);
      this.detaildatadialog = Object.assign({}, item);
      this.forid = item.foto_barang_id
      this.dialogedit = true;
      this.editdatafoto= Object.assign({}, item)
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
      if(this.filefoto){

        console.log("0")
        foto.append("file", this.filefoto);
      }else{

        console.log("1")
        foto.append("file", this.editdatafoto.file);
      }
      axios
        .post(
          "http://127.0.0.1:8000/api/updatefotobarang/" + this.forid,
          foto
        )
        .then((respon) => {
          location.reload();
          console.log(respon.data);
          this.$toasted.show('Berhasil ubah foto barang', {
        theme: 'success',
        position: 'top-right',
        className: 'edit-toast',
        duration: 3000
      })
        });
      Object.assign(this.fotobarang[this.indexnya], this.detaildatadialog);
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
          alert("berhasil hapus");
          location.reload();
          console.log(respon);
          this.$toasted.show('Berhasil hapus foto barang', {
        theme: 'success',
        position: 'top-right',
        className: 'edit-toast',
        duration: 3000
      })
        });
      // this.fotobarang.splice(this.indexnya, 1)
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
<style>
.edit-toast{
  background: green;
  color:white;
  padding: 10px ;
  border-radius: 20px;
}


.file-input {
  padding-bottom: 30px;
}
</style>
