

const SureToDelete = (e) => {
    if (!confirm('Are you sure? you wanna delete')) {
        e.preventDefault();
    }
}