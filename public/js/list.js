list = (token) => {
    return {
        isOpen: false,
        isCreate: false,
        isSuccess: false,
        alert: null,
        preview: null,
        posts: [],
        post: {
            id: '',
            title: '',
            description: '',
            image: '',
        },
        error: {
            title: null,
            description: null
        },

        get modalTitle() {
            return this.isCreate ? "Create Post" : "Edit Post";
        },

        get modalBtn() {
            return this.isCreate ? "Create" : "Update";
        },

        get previewUrl() {
            return this.preview ? this.preview : 'https://tuk-cdn.s3.amazonaws.com/can-uploader/add_user-svg2.svg';
        },

        toggle() {
            this.isOpen = !this.isOpen;
        },

        getPosts() {
            fetch("posts/get-all")
                .then((response) => response.json())
                .then((data) => (this.posts = data));
        },

        create() {
            this.clearInputs();
            this.clearErrors();
            this.isCreate = true;
            this.toggle();
        },

        store() {
            fetch("posts/store", {
                method: "POST",
                headers: { "X-CSRF-TOKEN": token },
                body: this.prepareFormData(),
            })
                .then((response) => response.json())
                .then((data) => {
                    if (!data.errors) {
                        this.toggle();
                        this.getPosts();
                        this.showAlert(data.message);
                        return;
                    }
                    throw data.errors;
                })
                .catch((error) => {
                    this.error.title = error.title[0];
                    this.error.description = error.description[0];
                });
        },

        edit(post) {
            this.clearInputs();
            this.clearErrors();
            this.isCreate = false;
            this.post.id = post.id;
            this.post.title = post.title;
            this.post.description = post.description;
            this.preview = post.image;
            this.toggle();
        },

        update() {
            fetch(`posts/${this.post.id}`, {
                method: "POST",
                headers: { "X-CSRF-TOKEN": token },
                body: this.prepareFormData(),
            })
                .then((response) => response.json())
                .then((data) => {
                    if (!data.errors) {
                        this.toggle();
                        this.getPosts();
                        this.showAlert(data.message);
                        return;
                    }
                    throw data.errors;
                })
                .catch(error => {
                    this.error.title = error.title[0];
                    this.error.description = error.description[0];
                })
        },

        prepareFormData() {
            const formData = new FormData();
            formData.append('title', this.post.title);
            formData.append('description', this.post.description);
            formData.append('image', this.post.image);
            if (!this.isCreate) formData.append('_method', 'PUT');
            return formData;
        },

        destroy(id) {
            if (!confirm('Are you sure want to delete?')) {
                return;
            }
            fetch(`posts/${id}`, {
                method: "DELETE",
                headers: { "X-CSRF-TOKEN": token },
            })
                .then(response => response.json())
                .then(data => {
                    this.getPosts();
                    this.showAlert(data.message);
                })
        },

        submit() {
            if (this.isCreate) {
                this.store();
                return;
            }
            this.update();
        },

        clearInputs() {
            this.post.id = '';
            this.post.title = '';
            this.post.description = '';
            this.post.image = '';
            this.preview = '';
        },

        clearErrors() {
            this.error.title = null;
            this.error.description = null;
        },

        showAlert(alert) {
            this.alert = alert;
            this.isSuccess = true;
            setTimeout(() => (this.isSuccess = false), 3000);
        },

        previewImg(event) {
            if (!event.target.files.length) return;
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = e => this.preview = e.target.result;
            this.post.image = file;
        },

        /**
         * Custom Pagination
         */
        search: '',
        pageNumber: 0,
        perPage: 10,
        total: '',
        start: '',
        end: '',

        get paginatedPosts() {
            start = this.pageNumber * this.perPage;
            end = start + this.perPage;

            if (!this.search) {
                this.total = this.posts.length;
                return this.posts.slice(start, end);
            }

            this.resetPagination();

            // return the total results of the filters
            this.total = this.posts.filter((item) => {
                return item.title
                    .toLowerCase()
                    .includes(this.search.toLowerCase());
            }).length;

            // return the filtered data
            return this.posts.filter((item) => {
                return item.title
                    .toLowerCase()
                    .includes(this.search.toLowerCase());
            }).slice(start, end);
        },

        get pageCount() {
            return Math.ceil(this.total / this.perPage);
        },

        // TODO: refactor numbers into meaningful one
        get paginationCount() {
            const pageCount = this.pageCount;
            const pageNumber = this.pageNumber;
            const pagination = [];

            if (pageCount > 9) {
                for (let page = 0; page < pageCount; page++) {
                    if (pageNumber < 7) {
                        if (page > 7 && page < pageCount - 1) {
                            pagination.push(0);
                            continue;
                        }
                        pagination.push(page + 1);
                        continue;
                    }
                    if (pageNumber > pageCount - 7) {
                        if (page > 1 && page < pageCount - 7) {
                            pagination.push(0);
                            continue;
                        }
                        pagination.push(page + 1);
                        continue;
                    }
                    if (page > 1 && page < pageNumber - 2 || page > pageNumber + 2 && page < pageCount - 1) {
                        pagination.push(0);
                        continue;
                    }
                    pagination.push(page + 1);
                    continue;
                }
                let first = pagination.splice(0, pageNumber + 1);
                let second = pagination.splice(0, pageCount + 1);
                return [...new Set(first), ...new Set(second)].map(item => item === 0 ? '...' : item);
            }
            return Array.from(Array(pageCount).keys(), n => n + 1);
        },

        get from() {
            return this.pageNumber * this.perPage + 1;
        },

        get to() {
            const currentPage = (this.pageNumber + 1) * this.perPage;
            return currentPage <= this.total ? currentPage : this.total;
        },

        next() {
            this.pageNumber++;
        },

        prev() {
            this.pageNumber--;
        },

        view(index) {
            this.pageNumber = index;
        },

        resetPagination() {
            this.pageNumber = 0;
            this.perPage = 10;
            start = this.pageNumber * this.perPage;
            end = start + this.perPage;
        }
    };
};
