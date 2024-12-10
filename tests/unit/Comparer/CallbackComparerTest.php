<?php

declare( strict_types = 1 );

namespace Diff\Tests\Comparer;

use Diff\Comparer\CallbackComparer;
use Diff\Tests\DiffTestCase;

/**
 * @covers \Diff\Comparer\CallbackComparer
 *
 * @group Diff
 * @group Comparer
 *
 * @license BSD-3-Clause
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class CallbackComparerTest extends DiffTestCase {

	public function testWhenCallbackReturnsTrue_valuesAreEqual() {
		$comparer = new CallbackComparer( static function () {
			return true;
		} );

		$this->assertTrue( $comparer->valuesAreEqual( null, null ) );
	}

	public function testWhenCallbackReturnsFalse_valuesAreNotEqual() {
		$comparer = new CallbackComparer( static function () {
			return false;
		} );

		$this->assertFalse( $comparer->valuesAreEqual( null, null ) );
	}

	public function testWhenCallbackReturnsNonBoolean_exceptionIsThrown() {
		$comparer = new CallbackComparer( static function () {
			return null;
		} );

		$this->expectException( \RuntimeException::class );
		$comparer->valuesAreEqual( null, null );
	}

	public function testCallbackIsGivenArguments() {
		$firstArgument = null;
		$secondArgument = null;

		$comparer = new CallbackComparer( static function ( $a, $b ) use ( &$firstArgument, &$secondArgument ) {
			$firstArgument = $a;
			$secondArgument = $b;
			return true;
		} );

		$comparer->valuesAreEqual( 42, 23 );

		$this->assertSame( 42, $firstArgument );
		$this->assertSame( 23, $secondArgument );
	}

}
