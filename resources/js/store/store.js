export default {
    state: {
        categories: [],
        brands: [],
        products: [],
        searchProducts: [],
        featuredProducts: [],
        newProducts: [],
        catProducts: [],
        catProducts12: [],
        catProducts7: [],
        singleProducts: [],
        cartProduct: [],
        countCart: [],
        subtotalCart: [],
        customerSession: [],
        productComment: [],
    },

    getters: {
        getCategory(state) {
            return state.categories;
        },
        getProducts(state) {
            console.log(state.products);
            return state.products;
        },
        getSearchProducts() {
            return state.searchProducts;
        },
        getBrand(state) {
            return state.brands;
        },
        getfeaturedProduct(state) {
            return state.featuredProducts;
        },
        getNewProduct(state) {
            return state.newProducts;
        },
        getCatProduct(state) {
            console.log(state.catProducts);
            return state.catProducts;
        },
        getCatProduct12(state) {
            return state.catProducts12;
        },
        getCatProduct7(state) {
            return state.catProducts7;
        },
        getSingleProduct(state) {
            return state.singleProducts;
        },
        getCartItem(state) {
            return state.cartProduct;
        },
        getCountCart(state) {
            return state.countCart;
        },
        getCartSubtotal(state) {
            return state.subtotalCart;
        },
        getSessionData(state) {
            return state.customerSession;
        },
        getCommentData(state) {
            return state.productComment;
        },
    },

    actions: {
        category(context) {
            axios.get("/all-category").then((response) => {
                //console.log(response.data)
                context.commit("allCategory", response.data);
            });
        },
        catProducts(context, payload) {
            axios.get("/category/" + payload).then((response) => {
                //console.log(response.data)
                context.commit("catProducts", response.data);
            });
        },

        searchProducts(context, payload) {
            // alert(payload);
            axios
                .post("/search-product", {
                    searchKey: payload,
                })
                .then((response) => {
                    // console.log(response.data.searchData);
                    context.commit("searchProducts", response.data.searchData);
                });
        },
        catProducts12(context, payload) {
            axios.get("/category/" + 12).then((response) => {
                //console.log(response.data)
                context.commit("getProductbyId12", response.data);
            });
        },
        catProducts7(context, payload) {
            axios.get("/category/" + 8).then((response) => {
                //console.log(response.data)
                context.commit("getProductbyId7", response.data);
            });
        },
        brand(context) {
            axios.get("/all-brand").then((response) => {
                //console.log(response.data)
                context.commit("allBrand", response.data);
            });
        },
        products(context) {
            axios.get("/all-products").then((response) => {
                //console.log(response.data)
                context.commit("allProducts", response.data);
            });
        },
        featuredProduct(context) {
            axios.get("/featured-product").then((response) => {
                //console.log(response.data)
                context.commit("featureProducts", response.data);
            });
        },
        newProduct(context) {
            axios.get("/new-product").then((response) => {
                //console.log(response.data)
                context.commit("getNewProduct", response.data);
            });
        },
        categoryByID(context, payload) {
            axios.get("/category/" + payload).then((response) => {
                //console.log(response.data)
                context.commit("getProductbyId", response.data);
            });
        },
        getProducstbyId(context, payload) {
            axios.get("/product-details/" + payload).then((response) => {
                //console.log(response.data)
                context.commit("getSingleProduct", response.data);
            });
        },
        getCartItem(context) {
            axios.get("/all-cart").then((response) => {
                //console.log(response.data.cart)
                context.commit("allCartItem", response.data.cart);
            });
        },
        countCart(context) {
            axios.get("/all-cart").then((response) => {
                //console.log(response.data.cart)
                context.commit("countCartItem", response.data.count_cart);
            });
        },
        getAllCarttotal(context) {
            axios.get("/all-cart").then((response) => {
                //console.log(response.data.cart)
                context.commit("allCarttotal", response.data.subtotal);
            });
        },
        customerSession(context) {
            axios.get("/customer-session").then((response) => {
                //console.log(response.data.s_customer)
                context.commit("sessionData", response.data.s_customer);
            });
        },
        getProductComment(context, payload) {
            axios.get("/product-comment/" + payload).then((response) => {
                //console.log(response.data)
                context.commit("commentData", response.data);
            });
        },
    },

    mutations: {
        getCatProducts(state, data) {
            return (state.catProducts = data);
        },
        allCategory(state, data) {
            return (state.categories = data);
        },
        allProducts(state, data) {
            return (state.products = data);
        },
        allBrand(state, data) {
            return (state.brands = data);
        },
        featureProducts(state, data) {
            return (state.featuredProducts = data);
        },
        getNewProduct(state, data) {
            return (state.newProducts = data);
        },
        searchProducts(state, data) {
            return (state.searchProducts = data);
        },
        getProductbyId(state, data) {
            return (state.catProducts = data);
        },
        getProductbyId12(state, data) {
            return (state.catProducts12 = data);
        },
        getProductbyId7(state, data) {
            return (state.catProducts7 = data);
        },
        getSingleProduct(state, data) {
            return (state.singleProducts = data);
        },
        allCartItem(state, data) {
            return (state.cartProduct = data);
        },
        countCartItem(state, data) {
            return (state.countCart = data);
        },
        allCarttotal(state, data) {
            return (state.subtotalCart = data);
        },
        sessionData(state, data) {
            return (state.customerSession = data);
        },
        commentData(state, data) {
            return (state.productComment = data);
        },
    },
};