            <footer class="d-flex flex-wrap justify-content-between align-items-center pt-4 mt-5 border-top">
                <div class="col-md-4 d-flex align-items-center">
                    <span class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1 i-icon">
                        <ion-icon name="code-slash-outline"></ion-icon> 
                    </span>
                    <span class="text-muted">© 2021 Moises Pontes</span>
                </div>

                <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
                    <li class="ms-3">
                        <a class="text-muted i-icon" href="https://www.instagram.com/moi.pontes/">
                            <ion-icon name="logo-instagram"></ion-icon>
                        </li>
                    <li class="ms-3">
                        <a class="text-muted i-icon" href="https://github.com/moisespontes">
                            <ion-icon name="logo-github"></ion-icon>
                        </a>
                    </li>
                    <li class="ms-3">
                        <a class="text-muted i-icon" href="https://www.linkedin.com/in/moisesapontes/">
                            <ion-icon name="logo-linkedin"></ion-icon>
                        </a>
                    </li>
                </ul>
            </footer>
            <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
            <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
            </script>
            <!-- include js app -->
            <?php if (isset($this->data['script'])) : ?>
                <?php foreach ($this->data['script'] as $script) :?> 
            <script type="text/javascript" src="<?= url("/assets/js/{$script}.js"); ?>"></script>
                <?php endforeach; ?>
            <?php endif;  ?> 
        </div>
    </body>

</html>