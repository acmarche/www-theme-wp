const { useEffect } = wp.element;

function DateFilter({
    dateSelector,
    setDateSelector,
    setDateSelectorValues,
    currentMonth,
    currentYear
}) {
    const fillDateSelector = () => {
        const hardCodedMonth = [
            'Jan',
            'Fev',
            'Mar',
            'Avr',
            'Mai',
            'Juin',
            'Jui',
            'Aout',
            'Sep',
            'Oct',
            'Nov',
            'Dec'
        ];
        const hardCodedNumber = [
            '01',
            '02',
            '03',
            '04',
            '05',
            '06',
            '07',
            '08',
            '09',
            '10',
            '11',
            '12'
        ];

        const selectorArray = [
            {
                name: 'Tout', id: 'tout', month: '', year: '', checked: true
            }
        ];

        for ( let i = 0; i < hardCodedMonth.length; i++ ) {
            const selectorObject = {
                name: hardCodedMonth[i],
                id: i + 1,
                month: hardCodedNumber[i],
                year:
                    hardCodedNumber[i] >= currentMonth ?
                        currentYear + 1900 :
                        currentYear + 1901,
                checked: false
            };

            selectorArray.push( selectorObject );
        }

        setDateSelector( selectorArray );
    };

    useEffect( () => {
        fillDateSelector();
    }, []);

    function changeSelectedCategory( temp_e ) {
        setDateSelectorValues( temp_e.target.value );
    }

    return (
        <>
            <div className="d-md-none pr-12px border border-dark-primary">
                <select
                    name="categories"
                    id="cat-select"
                    className="fs-short-3 ff-semibold"
                    onChange={( e ) => {
                        changeSelectedCategory( e );
                    }}
                >
                    {dateSelector.map( ( object, index ) => (
                        <option
                            key={index + 1000}
                            value={`${object.id}|${object.year}`}
                            defaultValue={object.checked}
                        >
                            {`${object.name} ${object.year}`}
                        </option>
                    ) )}
                </select>
            </div>

            <ul className="cat-filters d-md-flex mw-550px flex-wrap justify-content-center align-items-center d-none">
                {dateSelector.map( ( object, index ) => (
                    <li
                        key={index + 10000}
                        className={`${0 == index ? 'mx-16px' : ''} position-relative`}
                    >
                        <input
                            name="cat"
                            className="position-absolute top-0 bottom-0 left-0 right-0 w-100 h-100"
                            type="radio"
                            value={`${object.id}|${object.year}`}
                            defaultChecked={object.checked}
                            onClick={( e ) => {
                                changeSelectedCategory( e );
                            }}
                        />
                        <label
                            name="cat-all"
                            className="py-4px px-8px fs-short-2 ff-semibold transition-color"
                        >
                            {`${object.name} ${object.year}`}
                        </label>
                    </li>
                ) )}
            </ul>
        </>
    );
}

export default DateFilter;
