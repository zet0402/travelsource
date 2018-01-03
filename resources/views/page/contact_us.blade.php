@extends('master')
@section('content')
<div class="container">
            <h1 class="page-title">Contact Us</h1>
        </div>
<div class="container">
            <div class="gap"></div>
            <div class="row">
                <div class="col-md-7">
                    <p>Inceptos hac sagittis sit elit primis iaculis arcu quam justo per primis tempus ad iaculis cursus condimentum nullam pretium dui id sit lacus duis dignissim primis potenti aliquam malesuada ullamcorper</p>
                    <p>Euismod volutpat risus luctus id varius volutpat adipiscing porttitor egestas nisl nunc luctus phasellus nibh tristique lacinia penatibus justo urna</p>
                    <form class="mt30">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input class="form-control" type="text">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>E-mail</label>
                                    <input class="form-control" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Message</label>
                            <textarea class="form-control"></textarea>
                        </div>
                        <input class="btn btn-primary" type="submit" value="Send Message">
                    </form>
                </div>
                <div class="col-md-4">
                    <aside class="sidebar-right">
                        <ul class="address-list list">
                            <li>
                                <h5>Email</h5><a href="#">info@traveler.com</a>
                            </li>
                            <li>
                                <h5>Phone Number</h5><a href="#">+1 (426) 642-8525</a>
                            </li>
                            <li>
                                <h5>Skype</h5><a href="#">contact_traveller</a>
                            </li>
                            <li>
                                <h5>Address</h5><address>Traveler Ltd.<br>1355 Market St, Suite 900<br>San Francisco, CA 94103<br>United States<br></address>
                            </li>
                        </ul>
                    </aside>
                </div>
            </div>
            <div class="gap"></div>
        </div>       
@endsection