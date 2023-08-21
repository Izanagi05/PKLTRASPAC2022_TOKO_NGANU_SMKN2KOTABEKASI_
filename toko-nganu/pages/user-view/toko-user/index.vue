<template>
  <div>
    <Navbar />
    <div class="pl-15 pb-5 font-weight-medium">Detail Toko</div>
    <div>
      <div class="button-add pl-4 pb-6">
        <nuxt-link
          class="text-decoration-none px-15"
          to="/user-view/crud"
          ><v-btn class="btn-add rounded-pill white--text" color="#2f432d"
            >Tambah barang</v-btn
          ></nuxt-link
        >
      </div>

      <v-dialog v-model="dialogDelete" max-width="500px">
        <v-card>
          <v-card-title class="text-h5">Yakin ingin menghapus?</v-card-title>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue-darken-1" variant="text" @click="closeDelete"
              >Cancel</v-btn
            >
            <v-btn
              color="blue-darken-1"
              variant="text"
              @click="confirmhapustoko"
              >OK</v-btn
            >
            <v-spacer></v-spacer>
          </v-card-actions>
        </v-card>
      </v-dialog>

      <v-dialog
        v-model="dialogedit"
        max-width="700"
        persistent
        transition="dialog-bottom-transition"
      >
        <v-card
          class="kartu"
          light
          style="padding: 0px; color: black; border: solid 3px #4caf50"
        >
          <div style="background: #4caf50; padding: 10px 30px; color: white">
            <h1>Ubah data</h1>
          </div>
          <v-container style="padding: 30px">
            <v-text-field
              type="text"
              v-model="detaildatadialog.nama"
              label="Name"
              outline
            ></v-text-field>
            <v-text-field
              type="text"
              v-model="detaildatadialog.alamat"
              label="alamat"
              outline
            ></v-text-field>
            <v-text-field
              type="number"
              v-model="detaildatadialog.no_telepon"
              label="no telepon"
              outline
            ></v-text-field>
            <v-text-field
              type="text"
              v-model="detaildatadialog.deskripsi"
              label="deskripsi"
              outline
            ></v-text-field>
            <input type="file" v-on:change="upload" label="logo" />
            <!-- <div></div> -->
            <v-card-actions>
              <v-btn
                @click="closeedit()"
                style="margin-right: 20px; background: white; color: black"
                >Close</v-btn
              >
              <v-btn
                @click="updatetoko()"
                style="background: #4caf50; color: white"
                >Ubah</v-btn
              >
            </v-card-actions>
          </v-container>
        </v-card>
      </v-dialog>
      <v-data-table data-app :headers="headers" :items="Toko" class="px-15">
        <template v-slot:[`item.logo`]="{ item }">
          <div
                      class="image-container3 d-flex justify-center align-center">

            <img
          object-fit="cover" width="100%" height="100%"
            :src="'http://127.0.0.1:8000/storage/' + item.logo"
          />
        </div>
        </template>
        <template v-slot:[`item.aksi`]="{ item }">
          <!-- <v-btn
            class="mx-2"
            fab
            small
            @click="klikdetail(item)"
            style="margin: 15px 15px 15px 0px"
          >
            <v-icon dark>mdi-eye</v-icon>
          </v-btn> -->
          <v-btn
            class="mx-2"

            small
            @click="detailbarang(item)"
            style="margin: 15px 15px 15px 0px"
          >
            Detail barang
          </v-btn>
          <v-btn
            class="mx-2"
            fab
            small
            @click="ubahdata(item)"
            style="margin: 15px 15px 15px 0px"
          >
            <v-icon dark>mdi-pencil</v-icon>
          </v-btn>
          <v-btn
            class="mx-2"
            fab
            small
            @click="hapustoko(item)"
            style="background: #ff2a30"
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
      <v-container> </v-container>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  middleware: "middlewareku",
  data() {
    return {
      dialogDelete: false,
      dialogedit: false,
      datafoto: null,
      cari: null,
      nama: null,
      tokouser: null,
      Toko: [],
      UbahToko: null,
      edittokoid: null,
      tess: 18,

      datatoko: [],
      dialogdetail: false,
      dialogedit: false,
      indexnya: null,
      headers: [
        //  {text: 'Id Toko', align: 'start', value: 'toko_id'},
        { text: "Nama Toko", align: "start", value: "nama" },
        { text: "Alamat", align: "start", value: "alamat" },
        { text: "NO Telepon", align: "start", value: "no_telepon" },
        { text: "Deskripsi", align: "start", value: "deskripsi" },
        { text: "Logo", align: "start", value: "logo" },
        { text: "Aksi", align: "start", value: "aksi", width: "300px" },
      ],
      dialoghapus: false,

      //  detaildatadialog: [],
      detaildatadialog: {
        toko_id: "",
        nama: "",
        alamat: "",
        no_telepon: "",
        deskripsi: "",
        logo: "",
        barang: "",
      },
      defaultItem: {
        nama: "",
        alamat: "",
        no_telepon: "",
        deskripsi: "",
        logo: "",
      },
    };
  },
  methods: {
    gettoko() {
      axios
        .get("http://127.0.0.1:8000/api/gettoko/" + this.tokouser)
        .then((respon) => {
          this.Toko = respon.data;
          this.edittokoid = respon.data.toko_id;
        });
    },
    klikdetail(item) {
      this.detaildatadialog = Object.assign({}, item);
      this.dialogdetail = true;
    },
    detailbarang(item) {
      this.$router.push(`/user-view/toko-user/detailtoko/${item.toko_id}`);
    },
    closedetail() {
      this.$nextTick(() => {
        this.detaildatadialog = Object.assign({}, this.defaultItem);
      });
      this.dialogdetail = false;
    },

    ubahdata(item) {
      this.indexnya = this.Toko.indexOf(item);
      this.detaildatadialog = Object.assign({}, item);
      this.dialogedit = true;
    },
    closeedit() {
      this.$nextTick(() => {
        this.detaildatadialog = Object.assign({}, this.defaultItem);
      });
      this.dialogedit = false;
    },
    upload(foto) {
      let files = foto.target.files[0];
      this.datafoto = files;
      console.log(foto);
    },
    updatetoko() {
      let formData = new FormData();
      formData.append("nama", this.detaildatadialog.nama);
      formData.append("alamat", this.detaildatadialog.alamat);
      formData.append("no_telepon", this.detaildatadialog.no_telepon);
      formData.append("deskripsi", this.detaildatadialog.deskripsi);
      if(this.datafoto){

        formData.append("logo", this.datafoto);
      }else{

        formData.append("logo", this.detaildatadialog.logo);
      }
      axios.post(
        "http://127.0.0.1:8000/api/updatetoko/" + this.detaildatadialog.toko_id,
        formData,
        {
          "content-type": "multipart/form-data",
        }
      ) .then((respon) => {
        this.$toast.success("Berhasil update");
        this.gettoko()
          console.log(respon.data);
        });

      Object.assign(this.Toko[this.indexnya], this.detaildatadialog);
      this.dialogedit = false;
    },

    hapustoko(item) {
      this.editedIndex = this.Toko.indexOf(item);
      this.detaildatadialog = Object.assign({}, item);
      this.dialogDelete = true;
    },
    confirmhapustoko() {
      axios
        .delete(
          "http://127.0.0.1:8000/api/hapustoko/" + this.detaildatadialog.toko_id
        )
        .then((respon) => {
          console.log(respon);
          this.$toast.success("Berhasil update");
        });
      this.Toko.splice(this.editedIndex, 1);
      this.gettoko()
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

  mounted() {
     this.gettoko();
    //  this.gettoko();
    },

  created() {
    const userid = this.$cookies.get("cookieku");
    this.tokouser = userid.data.id;
    this.gettoko();
  },

};
</script>
<style>
.image-container3 {
  width:200px;
  height: 200px;
  overflow: hidden;
}

.image-container3 img {
  object-fit: cover;
  object-position: center;
}
.edit-toast{
  background: green;
  color:white;
  padding: 10px ;
  border-radius: 20px;
}</style>
