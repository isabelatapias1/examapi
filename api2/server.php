<?php

//definimos los campos a agendar

$information = [
    'agenda',
    
];
 
// validamos que halla la informacion solicitada



$resourceType = $_GET['resource_type'];

if ( !in_array($resourceType , $information ) ){

    http_response_code( 400 );
	echo json_encode(
		[
			'error' => "$resourcesType is un unkown",
		]
	);
   
    die;

}

//definicion de los campo a agendar 
$agenda = [
    1 => [
        'name'=> 'Manuel Mejia Araujo',
        'company'=> 'CocaCola',
        'image'=>'',
        'email'=> 'manjiaArau@example.com',
        'birthdate'=> '14/08/1992',
        'worknumber'=> '7562484',
        'personalnumber'=> '84576479548',
        'adress'=>'Pueblo nuevo 23#33',
    ],

    2 => [
        'name'=> 'Michael Benitez',
        'company'=> 'Coco&cafe',
        'profileImage'=>'',
        'email'=> 'michel_benitez2@example.com',
        'birthdate'=> '22/03/1997',
        'workPhonenumber'=> '7565455',
        'personalnumber'=> '4525875',
        'adress'=>'ricaute crr 54#87',
        ],
 
    3 => [
        'name'=> 'Cain jose Derbez',
        'company'=> 'pinchoscop',
        'profileImage'=>'',
        'email'=> 'derbezcain23@example.com',
        'birthdate'=> '21/03/1989',
        'workPhonenumber'=> '7554823',
        'personalnumber'=> '84754678548',
        'adress'=>'mirandela av 7 #33b bis ',
            ],
        ];

header('Content-Type: application/json');

//levantar el id de campo
$resourceId= array_key_exists('resource_id',$_GET) ? $GET['resource_id']:'';



    switch ( strtoupper( $_SERVER['REQUEST_METHOD']) ) {
        case 'GET':
            if ( "agenda" !== $resourceType ) {
                http_response_code( 404 );
    
                echo json_encode(
                    [
                        'error' => $resourceType .' not yet implemented :(',
                    ]
                );
    
                die;
            }
    
            if ( !empty( $resourceId ) ) {
                if ( array_key_exists( $resourceId, $agenda) ) {
                    echo json_encode(
                        $agenda[ $resourceId ]
                    );
                } else {
                    http_response_code( 404 );
    
                    echo json_encode(
                        [
                            'error' => 'persona'.$resourceId.' no registrada',
                        ]
                    );
                }
            } else {
                echo json_encode(
                    $agenda
                );
            }
    
            die;
            
            break;
        case 'POST':
            $json = file_get_contents( 'php://input' );
    
            $agenda[] = json_decode( $json );
            break;
        case 'PUT':
            if ( !empty($resourceId) && array_key_exists( $resourceId, $agenda) ) {
                $json = file_get_contents( 'php://input' );
                
                $agenda[ $resourceId ] = json_decode( $json, true );
    
                echo $resourceId;
            }
            break;
        case 'DELETE':
            if ( !empty($resourceId) && array_key_exists( $resourceId, $agenda) ) {
                unset( $agenda[ $resourceId ] );
            }
            break;
        default:
            http_response_code( 404 );
    
            echo json_encode(
                [
                    'error' => $_SERVER['REQUEST_METHOD'].' not yet implemented :(',
                ]
            );
    
            break;
    }


