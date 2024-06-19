
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('apply-filter').addEventListener('click', function() {
        const category1 = document.getElementById('category1').value;
        const category2 = document.getElementById('category2').value;
        
        const urlParams = new URLSearchParams(window.location.search);
        if (category1) {
            urlParams.set('category1', category1);
        } else {
            urlParams.delete('category1');
        }
        if (category2) {
            urlParams.set('category2', category2);
        } else {
            urlParams.delete('category2');
        }
        window.location.search = urlParams.toString();
    });
});
