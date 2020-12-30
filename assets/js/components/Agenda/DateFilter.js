const { useEffect } = wp.element;

function DateFilter({
    dateFilter,
    setDateFilter,
    setDateFilterId,
    currentMonth,
    currentYear,
    setIsBetweenDate
}) {
    const fillDateFilter = () => {
        const monthsNames = [
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
        const monthsNumbers = [
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

        const arrayOfObject = [
            {
                name: 'Tout', id: 0, month: '', year: '', checked: true
            }
        ];

        monthsNames.map( ( elem, index ) => {
            const monthName = monthsNames[index];
            const monthNumber = monthsNumbers[index];
            const currentMonthNumber = currentMonth;
            const id = 10 > index + 1 ? `0${index + 1}` : index + 1;
            let year = 1900;
            if ( monthNumber < currentMonthNumber ) {
                console.log( monthNumber, currentMonthNumber );
                year += currentYear + 1;
            } else {
                year += currentYear;
            }
            const object = {
                name: monthName,
                id,
                month: monthNumber,
                year,
                checked: false
            };
            arrayOfObject.push( object );
        });

        setDateFilter( arrayOfObject );
    };

    useEffect( () => {
        fillDateFilter();
    }, []);

    function changeSelectedCategory( temp_e ) {
        const eventDataFilterId = temp_e.target.value.split( '|' )[0];
        setDateFilterId( eventDataFilterId );

        const isBetweenDateValue = temp_e.target.value.split( '|' )[1];
        setIsBetweenDate( isBetweenDateValue );
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
                    {dateFilter.map( ( object, index ) => (
                        <option
                            key={index + 1000}
                            value={`${object.id}|${object.year}-${object.month}-01`}
                            defaultValue={object.checked}
                        >
                            {`${object.name} ${object.year}`}
                        </option>
                    ) )}
                </select>
            </div>

            <ul className="cat-filters d-md-flex mw-550px flex-wrap justify-content-center align-items-center d-none">
                {dateFilter.map( ( object, index ) => (
                    <li
                        key={index + 10000}
                        className={`${0 == index ? 'mx-16px' : ''} position-relative`}
                    >
                        <input
                            name="cat"
                            className="position-absolute top-0 bottom-0 left-0 right-0 w-100 h-100"
                            type="radio"
                            value={`${object.id}|${object.year}-${object.month}-01`}
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
