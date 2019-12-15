<?php
    function get_dashboard() 
    {
        return "<div class='container-fluid'>
                <div class='row'>
                    <div class='col-md-6'>
                        <div class='well'>
                            <div class='alert alert-success'>
                            <h3>Set compute power</h3>
                            </div>
                              <form class='form'>
                                <div class='form-group'>
                                  <label for='cpu_usage_input'>Max CPU (in percent)</label>
                                  <input class='form-control' id='cpu_usage_input' min='0' max='100' value='0' type='number'>
                                </div>
                                <div class='form-group'>
                                  <label for='ram_usage_input'>Max ram (in MB)</label>
                                  <input class='form-control' id='ram_usage_input' min='0' max='2000' value='0' type='number'>
                                </div>
                                <input type='range' name='points' min='0' max='10'>
                                <div class='form-group'>
                                  <input type='submit' class='btn btn-success' value='Save settings'>
                                </div>
                              </form>
                        </div>
                    </div>
                    <div class='col-md-6'>
                        <div class='well'>
                            <div class='alert alert-success'>
                            <h3>Subscriptions Agents</h3>
                            </div>
                        </div>
                    </div>
                </div>
                </div>";
    }
?>