<?php

namespace RallyeLecture\ctrl;

interface IControleur {
    function Index();
    function Create();
    function Store();
    function Show($id);
    function Edit($id);
    function Update();
    function Delete($id);
}


