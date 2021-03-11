function FiltreItemOption( propos ) {
    const { items } = propos;
    const objectArray = Object.entries( items );

    objectArray.forEach( ([ key, values ]) => {
        console.log( key );
        console.log( values );
    });

    return ( <>
        <optgroup label="Culture">
            <option value="1-1" selected>Bibliothèque</option>
            <option value="1-2">Cinéma</option>
            <option value="1-3">Musées</option>
            <option value="1-4">Statues / Sculptures</option>
        </optgroup>
    </> );
}

export default FiltreItemOption;
