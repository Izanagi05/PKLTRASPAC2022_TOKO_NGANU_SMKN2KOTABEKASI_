<template>
  <div>
    <Navbar />
    <div class="judul pb-4 pt-2 font-weight-bold" style="font-family: 'Poppins', sans-serif; font-size: 30px">
      <center>Detail Foto Barang</center>
    </div>
    <v-dialog v-model="dialogDelete" max-width="800px" color="ffffff">
        <v-card class="pt-15 px-8 pb-8 rounded-xl">
          <div class="text-h6 pl-4">
            Apakah kamu yakin ingin menghapus item ini?
          </div>
          <div class="grey--text text-body-2 pl-4 mt-4">
            Item yang sudah dihapus tidak bisa dikembalikan lagi
          </div>
          <div class="d-flex justify-end mt-15">
            <v-btn class="rounded-xl px-8" outlined @click="closeDelete"
              >Batal</v-btn
            >
            <v-btn
              class="rounded-xl px-8 ml-8 white--text"
              color="#FF3548"
              @click="confirmhapusfoto"
              >Hapus</v-btn
            >
          </div>
        </v-card>
      </v-dialog>
    <v-dialog v-model="dialogedit"  max-width="800px"
        persistent
        class="rounded-xl"
        transition="dialog-bottom-transition"
      >
        <v-card class="rounded-xl">
          <div class="text-h6 px-8 mb-6 py-6 white--text bg-update">Ubah data Foto Barang</div>
          <div class="pt-0 px-8 pb-8">
        <v-card-text style="padding: 30px">
          <div class="preview">
            <v-img v-if="preview" :src="preview" width="200px"></v-img>
          </div>
           <label for="fileInput" class="custom-file-upload mt-4 rounded-lg py-2 px-4 white--text ">
    <span>Choose File</span>
</label>
          <input accept="image/*" class="inputfileku" id="fileInput"  :rules="rules" type="file" placeholder="Pilih Foto"
            prepend-icon="mdi-camera" label="Pilih Foto" v-on:change="upload" />
        </v-card-text>
        <div class="d-flex justify-end mt-8">
          <v-btn class="rounded-xl px-8" outlined @click="closeedit()" >Kembali</v-btn>
          <v-btn class="rounded-xl ml-8 px-8 white--text"
                color="#4caf50" @click="updatefoto()">Ubah</v-btn>
        </div>
      </div>
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
                <v-btn cclass="text-capitalize px-8  mb-6 text-body-1 font-weight-medium rounded-pill white--text" color="#2f432d" v-bind="attrs" v-on="on"
                   @click="tambahfoto()">Tambah foto barang</v-btn>
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
          <v-btn class="mx-2 white--text btn-crkuup" fab small @click="ubahfoto(item)" >
            <v-icon dark>mdi-pencil</v-icon>
          </v-btn>
          <v-btn class="mx-2 white--text btn-crkuhap" fab small @click="hapusfoto(item)" >
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

          this.$toasted.success('Berhasil tambah foto barang', {
            position: 'top-right',
            className: 'edit-toast',
            duration: 3000
          })
          this.getfoto()
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
          console.log(respon.data);
          this.$toasted.success('Berhasil ubah foto barang', {
        position: 'top-right',
        className: 'edit-toast',
        duration: 3000
      })
        });
      Object.assign(this.fotobarang[this.indexnya], this.detaildatadialog);
      this.getfoto()
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
          this.$toasted.success('Berhasil hapus foto barang', {
        position: 'top-right',
        className: 'edit-toast',
        duration: 3000
      })
        });
      // this.fotobarang.splice(this.indexnya, 1)
      this.getfoto()
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
.edit-toast{
  background: green;
  color:white;
  padding: 10px ;
  border-radius: 20px;
}

</style>
