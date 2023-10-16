import axios from 'axios'
export const state = () => ({
  alldatabarang: [],
  // editedIndex: -1
  response:null

})

export const mutations= {
  GET_DATA(state, parsdata){
    state.alldatabarang=parsdata
    // console.log(parsdata)
  },
  CREATE_DATA(state, adddata){
    state.alldatabarang.push(adddata)
    // console.log(parsdata)
  },
  UPDATE_DATA(state, updtdata){
    const index = state.alldatabarang.findIndex(item => item.barang_id === parseInt(updtdata.barang_id));
    // const index = state.alldatabarang.findIndex(item => item.barang_id === updtdata.barang_id);
    console.log(updtdata)
    if (index !== -1) {
    const datasementara= state.alldatabarang

    datasementara[index]= updtdata
    state.alldatabarang=[...datasementara]
  }
  console.log(updtdata.barang_id);
  },
  DELETE_DATA(state, id){

    const index = state.alldatabarang.findIndex(item => item.barang_id === id);

    if (index !== -1) {
      // Hapus item dari array
      state.alldatabarang.splice(index, 1);
    }

  }

}
export const getters = {
  getdata: (state)=> state.alldatabarang,
  getresp: (state)=> state.response

}

export const actions ={
  async getdatabarang({commit}, paramId){
    axios
        .get("http://127.0.0.1:8000/api/getbarang/" + paramId)
        .then((respon) => {
          commit('GET_DATA', respon.data?.data)
        });
  },
  async tambahdata({commit}, newData){
    const formData = new FormData();
    formData.append("nama", newData.nama);
    formData.append("kategori_id",parseInt(newData.kategori_id));
    formData.append("toko_id",parseInt(newData.toko_id));
    formData.append("deskripsi", newData.deskripsi);
    axios
      .post(
        "http://127.0.0.1:8000/api/createbarang/" + newData.toko_id,
        formData,
        {
          "content-type": "multipart/form-data",
        }
      )
      .then((respon) => {
        commit('CREATE_DATA', respon.data?.data)
        console.log(respon);
        // this.$store.dispatch('getdatabarang', newData.idbrg);
        // this.barang.push(this.detaildatadialog)
        this.$router.push("/user-view/toko-user/detailtoko/"+newData.toko_id);
        // this.getbarang();
      });
  },
  async ubahdata({commit}, updatedata){
    const formData = new FormData();
    formData.append("nama", updatedata.nama);
    formData.append("kategori_id",parseInt(updatedata.kategori_id));
    formData.append("deskripsi", updatedata.deskripsi);
    axios
        .post(
          "http://127.0.0.1:8000/api/updatebarang/" +
          updatedata.barang_id,
        formData,
        {
          "content-type": "multipart/form-data",
        }
      )
      .then((respon) => {
        commit('UPDATE_DATA', respon.data?.data)
        console.log(respon.data)
        // this.getbarang();
        this.$toast.success("Berhasil update");
      });
  },
  async hapusdata({commit}, iddata){
    axios
    .delete(
      "http://127.0.0.1:8000/api/deletebarang/" +
      iddata
      )
      .then((respon) => {
      commit('DELETE_DATA', iddata)
      console.log(respon);
      // this.getbarang();
      // this.barang
      this.$toast.success("Berhasil hapus");
    });
  }
}


