import CategoryChildren from '../CategoryChildren';

function FiltreSelect( propos ) {
    const entries = Object.entries( propos.filtres );
    const data = Object.entries( propos.filtres );

    // console.log( entries );

    const listItems = Object.keys( propos.filtres )
        .forEach( ( key, values ) => {
            const filtre = Object.entries( propos.filtres[key]);
            console.log( filtre );
            const name = filtre[0][1];
            const icone = filtre[1][1];
            const elements = filtre[2][1];
            console.log( name );
            console.log( icone );
            console.log( elements );
        });

    return (
        <>
            <div className="d-block d-lg-none pr-12px border border-dark-primary">
                <select onChange={propos.setMarkerData} name="tabs" id="tab-select" className="fs-short-3 ff-semibold">
                    <optgroup label="Culture">
                        <option value="1-1" selected>Bibliothèque</option>
                        <option value="1-2">Cinéma</option>
                        <option value="1-3">Musées</option>
                        <option value="1-4">Statues / Sculptures</option>
                    </optgroup>
                </select>
            </div>
        </>
    );
}

export default FiltreSelect;
