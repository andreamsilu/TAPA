<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Become a TAPA Member</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <?php include "titleIcon.php" ?>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">
</head>
<style>
    .categories h2 {
        font-size: 1.5rem;
        font-weight: bold;
        text-align: center;
        margin-bottom: 2rem;
        color: #212529;
    }

    .categories .card {
        border-radius: 0.5rem;
        background-color: #f5f5f5;
        padding: 2rem;
        transition: transform 0.3s ease-in-out;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.05);
    }

    .categories .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
    }

    .categories ul {
        margin-bottom: 0;
        list-style: circle;
    }

    .categories ul li {
        font-size: 0.9rem;
        line-height: 1.5;
        color: #6c757d;
    }

    .categories .btn {
        border: #0F718A solid 1px;
        border-radius: 10px;
        margin-top: 1rem;
        padding: 0.75rem 1.25rem;
        font-size: 0.9rem;
        letter-spacing: 0.1rem;
    }

    .categories .btn:hover {
        background-color: #0F718A;
        color: #f5f5f5;
    }

    .categories .col h2 {
        margin-bottom: 1rem;
        font-size: 1.2rem;
        color: #0F718A;
    }

    .categories .col p {
        line-height: 1.5;
        color: #6c757d;
    }

    .card-title {
        color: #0F718A;
    }

    @media (min-width: 768px) {
        .categories .row {
            display: flex;
            justify-content: space-between;
        }
    }

    /* Additional improvements */

    .categories .card-img-top {
        width: 4rem;
        height: 2rem;
        border-radius: 50%;
        margin-bottom: 0.5rem;
    }

    .categories .list-group-item i {
        margin-right: 0.5rem;
        color: #0057b7;
    }

    .categories .btn-primary:hover a {
        color: #fff;
    }

    .categories .btn-primary.learn-more {
        background-color: #f5f5f5;
        border-color: #ddd;
        color: #6c757d;
    }

    .categories .btn-primary.learn-more:hover {
        background-color: #eee;
        border-color: #ddd;
    }
</style>

<body>
    <?php include "header.php" ?>
    <main id="main">
        <section id="categories" class="categories py-5">
            <div class="container">
                <h2 class="text-center mb-5">UNLOCK THE BENEFITS OF TAPA MEMBERSHIP CATEGORIES</h2>
                <div class="row row-cols-1 row-cols-md-2 g-4">
                    <div class="col-md-4">
                        <div class="card shadow-sm h-100">
                            <i class="bi bi-award text-primary card-img-top d-flex justify-content-center align-items-center fs-2"></i>
                            <div class="card-body">
                                <h5 class="card-title">Full Member</h5>
                                <p class="card-text">For psychology professionals with Bachelor's degree or above.</p>
                                <ul class="list-group list-group-flush mb-3">
                                    <li class="list-group-item">Exclusive member benefits</li>
                                    <li class="list-group-item">Discounted event registration</li>
                                    <li class="list-group-item">Voting rights in TAPA elections</li>
                                </ul>
                                <a href="registration.php" class="btn btn-primar">Register Now</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card shadow-sm h-100">
                            <i class="bi bi-person-badge text-success card-img-top d-flex justify-content-center align-items-center fs-2"></i>
                            <div class="card-body">
                                <h5 class="card-title">Associate Member I</h5>
                                <p class="card-text">For professionals with Diploma in psychology.</p>
                                <ul class="list-group list-group-flush mb-3">
                                    <li class="list-group-item">Access to member resources</li>
                                    <li class="list-group-item">Networking opportunities</li>
                                    <li class="list-group-item">Reduced event registration fees</li>
                                </ul>
                                <a href="registration.php" class="btn btn-primar">Register Now</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card shadow-sm h-100">
                            <i class="bi bi-person-badge text-warning card-img-top d-flex justify-content-center align-items-center fs-2"></i>
                            <div class="card-body">
                                <h5 class="card-title">Associate Member II</h5>
                                <p class="card-text">For professionals with Certificate in psychology.</p>
                                <ul class="list-group list-group-flush mb-3">
                                    <li class="list-group-item">Limited access to resources</li>
                                    <li class="list-group-item">Basic networking opportunities</li>
                                    <li class="list-group-item">Discounted rates on select events</li>
                                </ul>
                                <a href="registration.php" class="btn btn-primar">Register Now</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row row-cols-1 row-cols-md-2 g-4 mt-5">
                    <div class="col-md-4">
                        <div class="card shadow-sm h-100">
                            <i class="bi bi-mortarboard text-info card-img-top d-flex justify-content-center align-items-center fs-2"></i>
                            <div class="card-body">
                                <h5 class="card-title">Student Member</h5>
                                <p class="card-text">For registered psychology students at various levels.</p>
                                <ul class="list-group list-group-flush mb-3">
                                    <li class="list-group-item">Discounted student rates</li>
                                    <li class="list-group-item">Exclusive mentorship opportunities</li>
                                    <li class="list-group-item">Access to student-focused resources</li>
                                </ul>
                                <a href="registration.php" class="btn btn-primar">Register Now</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card shadow-sm h-100">
                            <i class="bi bi-people text-secondary card-img-top d-flex justify-content-center align-items-center fs-2"></i>
                            <div class="card-body">
                                <h5 class="card-title">Local Affiliate Member</h5>
                                <p class="card-text">For individuals interested in the field of psychology.</p>
                                <ul class="list-group list-group-flush mb-3">
                                    <li class="list-group-item">Access to select TAPA events</li>
                                    <li class="list-group-item">Networking opportunities</li>
                                    <li class="list-group-item">Stay updated on psychology news</li>
                                </ul>
                                <a href="registration.php" class="btn btn-primar">Register Now</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card shadow-sm h-100">
                            <i class="bi bi-globe text-dark card-img-top d-flex justify-content-center align-items-center fs-2"></i>
                            <div class="card-body">
                                <h5 class="card-title">Foreign Affiliate Member</h5>
                                <p class="card-text">For international individuals interested in psychology.</p>
                                <ul class="list-group list-group-flush mb-3">
                                    <li class="list-group-item">Online access to select resources</li>
                                    <li class="list-group-item">Discounted rates on virtual events</li>
                                    <li class="list-group-item">Connect with the global psychology community</li>
                                </ul>
                                <a href="registration.php" class="btn btn-primar">Register Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
    <?php include "footer.php" ?>
</body>
</html>