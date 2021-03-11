function FiltreItemOption( propos ) {
    const { items } = propos;
    const objectArray = Object.entries( items );

    objectArray.forEach( ([ key, values ]) => {
        console.log( key );
        console.log( values );
    });

    return ( <></> );
}

export default FiltreItemOption;
