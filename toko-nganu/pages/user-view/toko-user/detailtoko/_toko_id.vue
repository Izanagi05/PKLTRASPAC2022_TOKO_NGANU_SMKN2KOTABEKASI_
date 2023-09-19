<template>
  <div>
    <Navbar />
    <div class="pl-15 pb-5 font-weight-medium">Detail Barang</div>
    <!-- <v-dialog v-model="dialogDelete"  max-width="800px" class="rounded-xl">
        <v-card class="pt-15 px-8 pb-8 rounded-xl">
          <div class="text-h6 pl-4">Apakah kamu yakin ingin menghapus item ini?</div>
          <div class="grey--text text-body-2 pl-4 mt-4">
            Item yang sudah dihapus tidak bisa dikembalikan lagi
          </div>
          <div class="d-flex justify-end mt-15">
            <v-btn class="rounded-xl" outlined @click="closeDelete"
              >Batal</v-btn
            >
            <v-btn
            class="rounded-xl ml-8 white--text"
              color="#FF3548"
            @click="confirmhapusbarang"
            >Hapus</v-btn
          >
          </div>
      </v-card>
    </v-dialog> -->

    <DialogDelete :dialogDelete="dialogDelete" :confirmhapus="confirmhapusbarang" :closeDelete="closeDelete"/>
    <DialogUpdate :dialogedit="dialogedit" item="Barang"  :detaildatadialog="detaildatadialog" :closeedit="closeedit" :updateedit="updatebarang"/>
    <v-data-table class="px-15" :headers="headers" :items="Toko">
      <template v-slot:[`item.aksi`]="{ item }">
        <v-btn
          class="mx-2 white--text btn-crkuup"
          fab
          small
          @click="ubahbarang(item)"
          style="margin: 15px 15px 15px 0px"
        >
          <v-icon dark>mdi-pencil</v-icon>
        </v-btn>
        <v-btn
          class="mx-2"
          small
          @click="detailbarang(item)"
          style="margin: 15px 15px 15px 0px"
        >
          buat varian
        </v-btn>
        <v-btn
          class="mx-2"
          small
          @click="detailfotobarang(item)"
          style="margin: 15px 15px 15px 0px"
        >
          info foto barang
        </v-btn>
        <v-btn
          class="mx-2 white--text btn-crkuhap"
          fab
          small
          @click="hapusbarang(item)"
          style="background: #ff2a30"
        >
          <v-icon dark>mdi-delete</v-icon>
        </v-btn>
      </template>
    </v-data-table>
  </div>
</template>
<script>
import axios from "axios";
export default {
  middleware: "middlewareku",
  data() {
    return {
      prm: this.$route.params,
      dialogedit: false,
      dialogDelete: false,
      Toko: [],
      barangtoko: null,
      headers: [
        { text: "Nama Barang", value: "nama" },
        { text: "Deskripsi", value: "deskripsi" },
        { text: "Aksi", value: "aksi" },
      ],
      detaildatadialog: {
        barang_id: "",
        nama: "",
        deskripsi: "",
      },
      defaultItem: {
        nama: "",
        deskripsi: "",
      },

      // Toko:null,
    };
  },
  methods: {
    getbarang() {
      axios
        .get("http://127.0.0.1:8000/api/getbarang/" + this.prm.toko_id)
        .then((respon) => {
          this.Toko = respon.data?.data;
        });
    },
    detailbarang(item) {
      this.$router.push(
        `/user-view/toko-user/detailtoko/detailbarang/varianbarang/${item.barang_id}`
      );
    },
    detailfotobarang(item) {
      this.$router.push(
        `/user-view/toko-user/detailtoko/detailbarang/fotobarang/${item.barang_id}`
      );
    },
    ubahbarang(item) {
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
    updatebarang() {
      axios
        .post(
          "http://127.0.0.1:8000/api/updatebarang/" +
            this.detaildatadialog.barang_id,
          this.detaildatadialog
        )
        .then((respon) => {
          console.log(respon.data);
        });
      Object.assign(this.Toko[this.indexnya], this.detaildatadialog);
      this.dialogedit = false;
      this.$toast.success("Berhasil update");
    },

    hapusbarang(item) {
      this.editedIndex = this.Toko.indexOf(item);
      this.detaildatadialog = Object.assign({}, item);
      this.dialogDelete = true;
    },
    confirmhapusbarang() {
      axios
        .delete(
          "http://127.0.0.1:8000/api/deletebarang/" +
            this.detaildatadialog.barang_id
        )
        .then((respon) => {
          console.log(respon);
          this.$toast.success("Berhasil hapus");
        });
      this.Toko.splice(this.editedIndex, 1);
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
    const tokoid = this.$cookies.get("cookieku");
    this.barangtoko = tokoid.data.id;
    this.getbarang();
  },
};
</script>
