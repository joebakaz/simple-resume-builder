<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $resume->user->name }}'s Resume</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
    <link
        href='https://fonts.googleapis.com/css?family=Roboto:400,500,400italic,300italic,300,500italic,700,700italic,900,900italic'
        rel='stylesheet' type='text/css'>
        
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

<div class="content-wrapper mt-4">
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-12">
                <div class="card mb-5">
                    <div class="card-header">
                        <h3 class="card-title">
                            {{ $resume->user->name }} - {{ $resume->title }}
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid wrapper">
                            <div class="row">
                                <div class="sidebar-wrapper col-4">
                                    <div class="profile-container">
                                        <h1 class="name">
                                            {{ $resume->user->name }}
                                        </h1>
                                        <h3 class="tagline">
                                            {{ $resume->title }}
                                        </h3>
                                        <p>{{ $resume->about_me }}</p>
                                    </div>

                                    @if (!empty($educations))
                                        <div class="education-container container-block pb-3">
                                            <h2 class="container-block-title">Educations</h2>
                                            @foreach($educations as $education)
                                                <h4 class="degree">
                                                    {{ $education->degree }} <span class="text-xs">({{ $education->graduation_year }})</span>
                                                </h4>
                                                <h5 class="meta">
                                                    {{ $education->faculty }} in </br> {{ $education->school }}
                                                </h5>
                                            @endforeach
                                        </div>
                                        <!--//education-container-->
                                    @endif
                                </div>
                                <!--//sidebar-wrapper-->

                                <div class="main-wrapper col-8">
                                    @if (!empty($experiences))
                                        <section class="section experiences-section">
                                            <h2 class="section-title">
                                                <span class="icon-holder"><i class="fa-solid fa-briefcase"></i>
                                                </span>
                                                Experiences
                                            </h2>
                                            @foreach ($experiences as $experience)
                                                <div class="item">
                                                    <div class="meta">
                                                        <div class="upper-row">
                                                            <h3 class="job-title">
                                                                {{ $experience->job_title }}
                                                            </h3>
                                                            <div class="time">
                                                                {{ $experience->start_date }}
                                                                -
                                                                {{ isset($experience->end_date) ? $experience->end_date : 'Present' }}
                                                            </div>
                                                        </div>
                                                        <!--//upper-row-->
                                                        <div class="company">
                                                            {{ $experience->company }}
                                                        </div>
                                                    </div>
                                                    <!--//meta-->
                                                    <div class="details">
                                                        <p>{{ isset($experience->job_description) ? $experience->job_description : '' }}
                                                        </p>
                                                    </div>
                                                    <!--//details-->
                                                </div>
                                                <!--//item-->
                                            @endforeach

                                        </section>
                                        <!--//section-->
                                    @endif
                                </div>
                                <!--//main-body-->
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
</div>

</body>

</html>