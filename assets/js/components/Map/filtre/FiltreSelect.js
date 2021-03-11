import CategoryChildren from '../CategoryChildren';

function FiltreSelect( propos ) {
    const entries = Object.entries( propos.filtres );
    const data = Object.entries( propos.filtres );

    // console.log( entries );

    const listItems = Object.keys( propos.filtres )
        .forEach( ( key, values ) => {
            const filtres = propos.filtres[key];
            console.log( filtres );
            filtres.map( ( key2 ) => ( <></> ) );
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
