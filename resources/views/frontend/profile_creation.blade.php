@extends('frontend.layout')
@section('title', 'Job Search')
@section('content')

<main>
    <div class="profile-creation-top">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <div class="profile-image">
                        <img src="{{URL::asset(FRONTEND.'/assets/images/profilecreation/userimg.svg') }}" />
                        <img src="{{URL::asset(FRONTEND.'/assets/images/profilecreation/camera.svg') }}" />
                        <h4>Prashant Govare</h4>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="profile-contact">
                        <ul>
                            <li class="phone"> <img src="{{URL::asset(FRONTEND.'/assets/images/profilecreation/phone.svg') }}" /> 8483807781
                                <span> <img src="{{URL::asset(FRONTEND.'/assets/images/profilecreation/alerticon.svg') }}" /> verify </span>
                            </li>
                            <li class="email"> <img src="{{URL::asset(FRONTEND.'/assets/images/profilecreation/mail.svg') }}" />
                                prashantgovare@gmail.com
                                <span> <img src="{{URL::asset(FRONTEND.'/assets/images/profilecreation/verifiedicon.svg') }}" /> verified </span>
                            </li>
                            <li class="location"><img src="{{URL::asset(FRONTEND.'/assets/images/profilecreation/location.svg') }}" /> Pune </li>
                            <li class="workexp"><img src="{{URL::asset(FRONTEND.'/assets/images/profilecreation/workexp.svg') }}" /> 2.5 Years
                            </li>
                            <li class="deposit"><img src="{{URL::asset(FRONTEND.'/assets/images/profilecreation/deposit.svg') }}" /> 5.6 Lakhs /
                                Annum </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="user-progress-bar">
                        <div class="user-progress">
                            <div class="circle-wrap">
                                <div class="circle">
                                    <div class="mask full">
                                        <div class="fill"></div>
                                    </div>
                                    <div class="mask half">
                                        <div class="fill"></div>
                                    </div>
                                    <div class="inside-circle"> 30% </div>
                                </div>
                            </div>
                            <p>Profile Completed</p>
                            <h6> How to improve</h6>
                        </div>
                        <div class="user-progress">
                            <div class="circle-wrap">
                                <div class="circle">
                                    <div class="mask full">
                                        <div class="fill"></div>
                                    </div>
                                    <div class="mask half">
                                        <div class="fill"></div>
                                    </div>
                                    <div class="inside-circle"> 30% </div>
                                </div>
                            </div>
                            <p>Apply Limit</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="profile-creation-body">
        <div class="profile-title">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h3>Edit or create profile <span>( only complete profile recruiter shows intrest to view )
                            </span></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="profile-dashboard">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="profile-sidebar">
                            <h6>Profile Last Updated : 01 March, 2022</h6>
                            <h4>Quick Links</h4>
                            <ul>
                                <li> <img src="{{URL::asset(FRONTEND.'/assets/images/profilecreation/sidebar1.svg') }}" /> Attach Resume <span>
                                        <img src="{{URL::asset(FRONTEND.'/assets/images/profilecreation/check.svg') }}" />
                                    </span> </li>
                                <li> <img src="{{URL::asset(FRONTEND.'/assets/images/profilecreation/sidebar2.svg') }}" /> Resume Headline <span>
                                        <img src="{{URL::asset(FRONTEND.'/assets/images/profilecreation/check.svg') }}" />
                                    </span> </li>
                                <li> <img src="{{URL::asset(FRONTEND.'/assets/images/profilecreation/sidebar3.svg') }}" /> Key Skill<span>
                                        <img src="{{URL::asset(FRONTEND.'/assets/images/profilecreation/check.svg') }}" />
                                    </span> </li>
                                <li> <img src="{{URL::asset(FRONTEND.'/assets/images/profilecreation/sidebar4.svg') }}" /> Employment <span>
                                        <img src="{{URL::asset(FRONTEND.'/assets/images/profilecreation/check.svg') }}" />
                                    </span> </li>
                                <li> <img src="{{URL::asset(FRONTEND.'/assets/images/profilecreation/sidebar5.svg') }}" /> Education <span>
                                        <img src="{{URL::asset(FRONTEND.'/assets/images/profilecreation/check.svg') }}" />
                                    </span> </li>
                                <li> <img src="{{URL::asset(FRONTEND.'/assets/images/profilecreation/sidebar6.svg') }}" /> Profile Summary <span>
                                        <img src="{{URL::asset(FRONTEND.'/assets/images/profilecreation/check.svg') }}" />
                                    </span> </li>
                                <li> <img src="{{URL::asset(FRONTEND.'/assets/images/profilecreation/sidebar7.svg') }}" /> Current Location
                                    <span>
                                        <img src="{{URL::asset(FRONTEND.'/assets/images/profilecreation/close.svg') }}" />
                                    </span> </li>
                                <li> <img src="{{URL::asset(FRONTEND.'/assets/images/profilecreation/sidebar8.svg') }}" /> Total Experience
                                    <span>
                                        <img src="{{URL::asset(FRONTEND.'/assets/images/profilecreation/close.svg') }}" />
                                    </span> </li>
                                <li> <img src="{{URL::asset(FRONTEND.'/assets/images/profilecreation/sidebar9.svg') }}" /> IT Skill <span>
                                        <img src="{{URL::asset(FRONTEND.'/assets/images/profilecreation/close.svg') }}" />
                                    </span> </li>
                                <li> <img src="{{URL::asset(FRONTEND.'/assets/images/profilecreation/sidebar10.svg') }}" /> Personal Details
                                    <span>
                                        <img src="{{URL::asset(FRONTEND.'/assets/images/profilecreation/close.svg') }}" />
                                    </span> </li>
                            </ul>

                        </div>

                    </div>
                    <div class="col-md-9">
                        <div class="profile-dashboard-content">
                            <div class="resume-upload">
                                <div class="d-flex">
                                    <h4>Resume</h4>
                                    <a href="#">Delete Resume </a>
                                </div>
                                <p>Resume is the most important document recruiters look for Recruiters.</p>
                                <form>
                                    <input type="file" name="uploadfile" id="Resume" style="display:none;">
                                    <label for="Resume">Update New Resume</label>
                                </form>
                                <div class="form-dflex">
                                    <span>Supported Format- doc, pdf, upto 2 MB </span>
                                    <img src="{{URL::asset(FRONTEND.'/assets/images/profilecreation/download.svg') }}" />
                                </div>
                            </div>
                            <div class="resume-upload resume-headline">
                                <div class="d-flex">
                                    <h4>Resume Headline </h4>
                                    <span><img src="{{URL::asset(FRONTEND.'/assets/images/profilecreation/edit.svg') }}" /> Edit</span>
                                </div>
                                <form>
                                    <textarea name="textarea" rows="3" cols="30"
                                        placeholder="Add Headline e.g : Design Engineer with 5.6 year experience in Automotive Plastic Product Design with 1 year BIW design."></textarea>
                                    <span> 0/250 </span>
                                    <div class="form-buttons">
                                        <button type="button" class="btn btn-cancel">Cancel</button>
                                        <button type="button" class="btn btn-save">Save</button>
                                    </div>
                                </form>

                            </div>
                            <div class="resume-upload resume-headline keyskills">
                                <div class="d-flex">
                                    <h4>Key Skills </h4>
                                    <span><img src="{{URL::asset(FRONTEND.'/assets/images/profilecreation/edit.svg') }}" /> Add</span>
                                </div>
                                <ul>
                                    <li>Catia V5 <img src="{{URL::asset(FRONTEND.'/assets/images/profilecreation/cancel.svg') }}" /> </li>
                                    <li>UGNX <img src="{{URL::asset(FRONTEND.'/assets/images/profilecreation/cancel.svg') }}" /> </li>
                                    <li>Plastic Domain <img src="{{URL::asset(FRONTEND.'/assets/images/profilecreation/cancel.svg') }}" /> </li>
                                </ul>
                                <form>
                                    <input type="text" class="form-control"
                                        placeholder="Add Technical Skill ( maximum 10 or 300 charactors)" />
                                    <div class="form-buttons">
                                        <button type="button" class="btn btn-cancel">Cancel</button>
                                        <button type="button" class="btn btn-save">Save</button>
                                    </div>
                                </form>
                            </div>
                            <div class="resume-upload resume-headline employement">
                                <div class="d-flex">
                                    <h4>Employment </h4>
                                    <span><img src="{{URL::asset(FRONTEND.'/assets/images/profilecreation/edit.svg') }}" /> Add</span>
                                </div>
                                <h5>Sphinx Worldbiz Ltd - Full-time - Jun 2016 to May 2019 (3 years) <span><img
                                            src="{{URL::asset(FRONTEND.'/assets/images/profilecreation/edit.svg') }}" /> Edit</span> </h5>
                                <p><span>Job Profile :</span> Product Design, 3D modelling, Assembly section
                                    creations, Adaptor geometry construction, Assembly drawings, Concept making and
                                    Interior and exterior trim design. Body panel and trim mounting s fitment
                                    requirements and optimization Concept making and Interior and exterior trim
                                    design exterior trim...</p>
                                <span class="chevron-up"><img
                                        src="{{URL::asset(FRONTEND.'/assets/images/profilecreation/chevronup.svg') }}" /></span>
                                <form>
                                    <div class="row">
                                        <div class="col-md-12 delete">
                                            <a href="#">Delete</a>
                                        </div>
                                        <div class="col-md-6 form-checkbox">
                                            <p>Is this your current employment?</p>
                                            <div class="d-flex">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="flexCheckDefault">
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Yes
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="flexCheckDefault">
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        No
                                                    </label>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-6 form-checkbox">
                                            <p>Employment Type</p>
                                            <div class="d-flex">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="flexCheckDefault">
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Full-time
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="flexCheckDefault">
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Part-time
                                                    </label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Industry type *</label>
                                            <select class="form-control" aria-label="Default select example">
                                                <option selected>Select industry</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Department *</label>
                                            <select class="form-control" aria-label="Default select example">
                                                <option selected>Select Department</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Current Company Name *</label>
                                            <input type="text" placeholder="Add company name"
                                                class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Current Designation *</label>
                                            <input type="text" placeholder="Add designation" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row form-selectbox">
                                        <div class="col-md-6">
                                            <label>Joining Date *</label>
                                            <div class="d-flex">
                                                <select class="form-control" aria-label="Default select example">
                                                    <option selected>Year</option>
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                </select>
                                                <select class="form-control" aria-label="Default select example">
                                                    <option selected>Month</option>
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Working till *</label>
                                            <div class="d-flex">
                                                <select class="form-control" aria-label="Default select example">
                                                    <option selected>Year</option>
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                </select>
                                                <select class="form-control" aria-label="Default select example">
                                                    <option selected>Month</option>
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-selectbox one-select">
                                        <div class="col-md-6">
                                            <label>Current Annual Salary *</label>
                                            <div class="d-flex">
                                                <select class="form-control" aria-label="Default select example">
                                                    <option selected>0 Lakh</option>
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                </select>
                                                <select class="form-control" aria-label="Default select example">
                                                    <option selected>0 Thousand </option>
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Notice Period *</label>
                                            <div class="d-flex">
                                                <select class="form-control" aria-label="Default select example">
                                                    <option selected>Select notice period</option>
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Job Profile</label>
                                            <textarea name="textarea" rows="7" cols="30" placeholder=""></textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-buttons">
                                                <button type="button" class="btn btn-cancel">Cancel</button>
                                                <button type="button" class="btn btn-save">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="resume-upload resume-headline employement">
                                <div class="d-flex">
                                    <h4>Education </h4>
                                    <span><img src="{{URL::asset(FRONTEND.'/assets/images/profilecreation/edit.svg') }}" /> Add</span>
                                </div>
                                <div class="education-list">
                                    <h5>10th : CBC - English - 2008 <span><img
                                                src="{{URL::asset(FRONTEND.'/assets/images/profilecreation/edit.svg') }}" /> Edit</span></h5>
                                    <h5>12th : CBC - English - 2010 <span><img
                                                src="{{URL::asset(FRONTEND.'/assets/images/profilecreation/edit.svg') }}" /> Edit</span></h5>
                                </div>
                                <span class="chevron-up"><img
                                        src="{{URL::asset(FRONTEND.'/assets/images/profilecreation/chevronup.svg') }}" /></span>
                                <form>
                                    <div class="row">
                                        <div class="col-md-12 delete">
                                            <a href="#">Delete</a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Education *</label>
                                            <select class="form-control" aria-label="Default select example">
                                                <option selected>Select Education</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Course / board *</label>
                                            <select class="form-control" aria-label="Default select example">
                                                <option selected>Select Course</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Specialization *</label>
                                            <select class="form-control" aria-label="Default select example">
                                                <option selected>Select Specialization</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>University/Institute *</label>
                                            <select class="form-control" aria-label="Default select example">
                                                <option selected>Select University/Institute</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 form-checkbox">
                                            <p>Course type *</p>
                                            <div class="d-flex">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="flexCheckDefault">
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Full time
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="flexCheckDefault">
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Part time
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="flexCheckDefault">
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Distance learning
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Passing Out Year *</label>
                                            <select class="form-control" aria-label="Default select example">
                                                <option selected>Select Passing Out Year</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Marks / Grade</label>
                                            <select class="form-control" aria-label="Default select example">
                                                <option selected>Add marks / grade</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-buttons">
                                                <button type="button" class="btn btn-cancel">Cancel</button>
                                                <button type="button" class="btn btn-save">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="resume-upload resume-headline current-location">
                                <form class="current-location">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h4>Current Location </h4>
                                            <select class="form-control" aria-label="Default select example">
                                                <option selected>Select city</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h4>Total Experience </h4>
                                            <div class="d-flex">
                                                <select class="form-control" aria-label="Default select example">
                                                    <option selected>Year</option>
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                </select>
                                                <select class="form-control" aria-label="Default select example">
                                                    <option selected>Month</option>
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-buttons">
                                                <button type="button" class="btn btn-cancel">Cancel</button>
                                                <button type="button" class="btn btn-save">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="resume-upload resume-headline employement">
                                <div class="d-flex">
                                    <h4>IT skill </h4>
                                    <span><img src="{{URL::asset(FRONTEND.'/assets/images/profilecreation/edit.svg') }}" /> Add</span>
                                </div>
                                <div class="education-list">
                                    <h5>Python - Experience- 2 year<span><img
                                                src="{{URL::asset(FRONTEND.'/assets/images/profilecreation/edit.svg') }}" /> Edit</span></h5>
                                </div>
                                <span class="chevron-up"><img
                                        src="{{URL::asset(FRONTEND.'/assets/images/profilecreation/chevronup.svg') }}" /></span>
                                <form>
                                    <div class="row">
                                        <div class="col-md-12 delete">
                                            <a href="#">Delete</a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Software / skill Name *</label>
                                            <input type="text" placeholder="Add software / skill name"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="row form-selectbox">
                                        <div class="col-md-6">
                                            <label>Experience *</label>
                                            <div class="d-flex">
                                                <select class="form-control" aria-label="Default select example">
                                                    <option selected="">Year</option>
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                </select>
                                                <select class="form-control" aria-label="Default select example">
                                                    <option selected="">Month</option>
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-buttons">
                                                <button type="button" class="btn btn-cancel">Cancel</button>
                                                <button type="button" class="btn btn-save">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="resume-upload resume-headline employement personal-details">
                                <div class="d-flex">
                                    <h4>Personal Details </h4>
                                    <span><img src="{{URL::asset(FRONTEND.'/assets/images/profilecreation/edit.svg') }}" /> Add/edit</span>
                                </div>
                                <div class="education-list">
                                    <ul>
                                        <li>Personal : <span>Male, Married</span> </li>
                                        <li>Date of Birth : <span> 26 Apr 1991 </span> </li>
                                        <li>Work Permit : <span> Germeny</span> </li>
                                    </ul>
                                    <p>Address : <span> Rz 80 5D, Shankar Park, West Sagarpur, South West Delhi,
                                            110046</span> </p>
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Languages : </th>
                                                <th>Proficiency </th>
                                                <th>Read</th>
                                                <th>Write</th>
                                                <th>Speak</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Hindi </td>
                                                <td>Proficient</td>
                                                <td><img src="{{URL::asset(FRONTEND.'/assets/images/profilecreation/tablecheck.svg') }}" /></td>
                                                <td><img src="{{URL::asset(FRONTEND.'/assets/images/profilecreation/tablecheck.svg') }}" /></td>
                                                <td><img src="{{URL::asset(FRONTEND.'/assets/images/profilecreation/tablecheck.svg') }}" /></td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                                <span class="chevron-up"><img
                                        src="{{URL::asset(FRONTEND.'/assets/images/profilecreation/chevronup.svg') }}" /></span>
                                <form>
                                    <div class="row">
                                        <div class="col-md-12 delete">
                                            <a href="#">Delete</a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label>Gender </label>
                                            <select class="form-control" aria-label="Default select example">
                                                <option selected="">Select gender</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label>Marital Status </label>
                                            <select class="form-control" aria-label="Default select example">
                                                <option selected="">Select status</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row dob">
                                        <div class="col-md-6">
                                            <label>Date of Birth</label>
                                            <div class="d-flex">
                                                <select class="form-control" aria-label="Default select example">
                                                    <option selected="">Day</option>
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                </select>
                                                <select class="form-control" aria-label="Default select example">
                                                    <option selected="">Month</option>
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                </select>
                                                <select class="form-control" aria-label="Default select example">
                                                    <option selected="">Year</option>
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Permanent Address</label>
                                            <input type="text" placeholder="Add permanent address"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label>Permanent Address</label>
                                            <input type="text" placeholder="Add PIN code" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Work Permit for Other Countries</label>
                                            <select class="form-control" aria-label="Default select example">
                                                <option selected="">Select countries ( max 5 )</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row languages">
                                        <div class="col-md-3">
                                            <label>Languages </label>
                                            <br />
                                            <select class="form-control" aria-label="Default select example">
                                                <option selected="">Add</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Proficiency </label>
                                            <br />
                                            <select class="form-control" aria-label="Default select example">
                                                <option selected="">Select</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 form-checkbox">
                                            <p>Read</p>
                                            <div class="d-flex">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="flexCheckDefault">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 form-checkbox">
                                            <p>Write</p>
                                            <div class="d-flex">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="flexCheckDefault">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 form-checkbox">
                                            <p>Speak</p>
                                            <div class="d-flex">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="flexCheckDefault">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row add-another">
                                        <div class="col-md-12">
                                            <a href="#">Add Another Language</a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-buttons">
                                                <button type="button" class="btn btn-cancel">Cancel</button>
                                                <button type="button" class="btn btn-save">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>



</main>


@stop
